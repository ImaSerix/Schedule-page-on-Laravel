<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Run;

class RunsController extends Controller
{
    function store(Request $request){
        if (!Auth::check() || $request->user()->cannot('store', Run::class)) {
            abort(403, 'Permission Denied');
        }
        $request->validate([
            'startTime' => 'required|integer|max:1499|min:0',
            'routeID' => 'required|integer'
        ]);
        Run::firstOrCreate(['route_id' => $request->routeID, 'is_work_day' => $request->isWorkDay, 'start_time' => $request->startTime]);
        return redirect()->back(); 
    }

    function delete(Request $request){
        if (!Auth::check() || $request->user()->cannot('delete', Run::class)) {
            abort(403, 'Permission Denied');
        }
        Log::info($request);
        $request->validate([
            'runID' => 'required|integer'
        ]);
        $run = Run::find($request->runID);
        $run->delete();
    }
}
