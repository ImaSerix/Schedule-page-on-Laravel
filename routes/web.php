<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\SavedNetworkController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\SheduleController;
use App\Http\Controllers\RunsController;



Route::get('/', function () {
    return view('satiksme/main');
});

Route::get('/schedule/{network_id}', [SheduleController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/runs', [RunsController::class, 'store'])->name('run.store');
Route::delete('/runs', [RunsController::class, 'delete'])->name('run.delete');


Route::get('lang/{locale}', [LocalizationController::class, 'switch'])->name('lang.switch');

Route::get('api/settings/tabs', [UserSettingController::class, 'getTabOrder']);
Route::post('api/settings/tabs', [UserSettingController::class, 'saveTabOrder']);
Route::get('api/translate/{phrase}', [LocalizationController::class, 'translate']);

Route::get('api/savedNetworks', [SavedNetworkController::class, 'read']);
Route::post('saveNetwork', [SavedNetworkController::class, 'store']);
Route::delete('api/unSaveNetwork/{network}', [SavedNetworkController::class, 'delete']);

Route::put('/schedule', [SheduleController::class, 'update'])->name('schedule.update');

Route::get('/api/route/{routeID}/stops', [SheduleController::class, 'getStops']);
Route::get('/api/stops/{routeID}/{isWorkDay}/startTimes', [SheduleController::class, 'getStartTimes']);
Route::get('/api/stops/{routeID}/{isWorkDay}/schedule', [SheduleController::class, 'getSheduleForStop']);

Route::get('api/tab/{tab}', [TabController::class, 'getTab']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
