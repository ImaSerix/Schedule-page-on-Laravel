<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;


class LocalizationController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['en', 'lv'])) {
            abort(400);
        }
        
        Session::put('locale', $locale);
        App::setLocale($locale);
        return redirect('/');
    }
    public function translate($phrase){
        $translation = Lang::get('messages.'.$phrase);
        return response()->json($translation);
    }
}
