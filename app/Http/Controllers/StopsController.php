<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stop;

class StopsController extends Controller
{
    public function show (){
        return response()->json(Stop::all()->toArray());
    }
}
