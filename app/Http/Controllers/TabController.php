<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RouteNetwork;
use App\Models\SavedNetworks;

class TabController extends Controller
{
    public function getTab($tab){
        if ($tab == 'all') return response()->json(RouteNetwork::all(['id', 'name','transport_type', 'description'])->toArray());
        else if ($tab == 'saved') {
            $savedNetworks = SavedNetworks::where('user_id', Auth::id())->pluck('route_network_id')->toArray();
            return response()->json(RouteNetwork::select('id', 'name','transport_type', 'description')->whereIn('id', $savedNetworks)->get()->toArray());
        }
        else return response()->json(RouteNetwork::select('id', 'name','transport_type', 'description')->where('transport_type', $tab)->get()->toArray());
    }
}
