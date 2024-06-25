<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedNetworks;
use Illuminate\Http\Request;

class SavedNetworkController extends Controller
{
    public function savedNetworks(){
        if (Auth::check()){
            $smth = SavedNetworks::select('route_network_id')->where('user_id', Auth::id())->get();
            return response()->json(array('auth' => true, 'saved' => $smth));
        }
        else return response()->json(array('auth' => false));
    }
    public function saveNetwork($network){
        SavedNetworks::create(['route_network_id' => $network, 'user_id' => Auth::id()]);
        return response()->json();
    }
    public function unSaveNetwork($network){
        SavedNetworks::where(['route_network_id' => $network, 'user_id' => Auth::id()])->delete();
        return response()->json();
    }
}
