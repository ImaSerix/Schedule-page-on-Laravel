<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\SavedNetworkController;
use App\Http\Controllers\TabController;


Route::get('/', function () {
    return view('satiksme/main');
});

Route::get('/schedule', function(){
    return view('satiksme/schedule');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('lang/{locale}', [LocalizationController::class, 'switch'])->name('lang.switch');


Route::get('api/settings/tabs', [UserSettingController::class, 'getTabOrder']);
Route::post('api/settings/tabs', [UserSettingController::class, 'saveTabOrder']);
Route::get('api/translate/{phrase}', [LocalizationController::class, 'translate']);

Route::get('api/savedNetworks', [SavedNetworkController::class, 'savedNetworks']);
Route::get('api/saveNetwork/{network}', [SavedNetworkController::class, 'saveNetwork']);
Route::get('api/unSaveNetwork/{network}', [SavedNetworkController::class, 'unSaveNetwork']);



Route::get('api/tab/{tab}', [TabController::class, 'getTab']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
