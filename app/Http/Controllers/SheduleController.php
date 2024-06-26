<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouteNetwork;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SheduleController extends Controller
{
    public function index($network_id){
        $routeNetwork = RouteNetwork::find($network_id);
        $routes = $routeNetwork->routes()->get()->toArray();
        return view('satiksme/schedule', compact('routeNetwork', 'routes'));
    }
    public function update(Request $request){
        if (!Auth::check() || $request->user()->cannot('update', Schedule::class)) {
            abort(403, 'Permission Denied');
        }
        $request->validate([
            'stopID' => 'required|integer',
            'newTimeDelta' => 'required|integer',
            'routeID' => 'required|integer',
        ]);
        Schedule::where(['stop_id' => $request->stopID, 'route_id' => $request->routeID,'is_work_day' => $request->isWorkDay])->limit(1)->update(array('time_delta' => $request->newTimeDelta));
    }

    public function getStops($routeID){
        $stops = array();
        $route = Route::find($routeID);
        $schedules = $route->schedules()->where('is_work_day', 1)->orderBy('order')->get();
        foreach($schedules as $schedule){
            array_push($stops, $schedule->stop()->get()[0]);
        }
        return response()->json($stops);
    }
    public function getStartTimes($routeID, $isWorkDay){
        $route = Route::find($routeID);
        $runs = $route->runs()->where('is_work_day', $isWorkDay)->orderBy('start_time')->get()->toArray();
        return response()->json($runs);
    }
    public function getSheduleForStop($routeID, $isWorkDay){
        $schedule = Schedule::where(['route_id' => $routeID, 'is_work_day' => $isWorkDay])->orderBy('order')->get()->toArray();
        return response()->json($schedule);
    }
}
