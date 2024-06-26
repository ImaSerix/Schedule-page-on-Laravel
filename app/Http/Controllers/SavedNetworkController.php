<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedNetworks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SavedNetworkController extends Controller
{   
    public function read(){
        if (Auth::check()){
            $smth = SavedNetworks::select('route_network_id')->where('user_id', Auth::id())->get();
            return response()->json(array('auth' => true, 'saved' => $smth));
        }
        else return response()->json(array('auth' => false));
    }
    public function store(Request $request){
        // $request->validate([
        //     'network' => 'integer',
        // ]);

        Log::info('Store method called');

        $network_id = $request->input('network_id');
        if (Auth::check()) Log::info('User authentificated');
        else Log::info('User is not authentificated');
        SavedNetworks::create(['route_network_id' => $network_id, 'user_id' => Auth::id()]);
        return response()->json();
    }
    public function delete(Request $request){
        $request->validate([
            'network' => 'integer',
        ]);
        
        SavedNetworks::where(['route_network_id' => $request->network, 'user_id' => Auth::id()])->delete();
        return response()->json();
    }
}
