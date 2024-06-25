<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function getTabOrder(){
        if (Auth::check()){
            $settings = UserSettings::where('user_id', Auth::id())->first();
            return response()->json($settings ? json_decode($settings->settings) : []);
        }
        else{
            return response()->json(array('tab_order' => array('All', 'bus', 'tram')));
        }
    }

    public function saveTabOrder(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        $settings = UserSettings::updateOrCreate(
            ['user_id' => Auth::id()],
            ['settings' => $request->settings]
        );

        return response()->json(['success' => true, 'settings' => $settings]);
    }
}
