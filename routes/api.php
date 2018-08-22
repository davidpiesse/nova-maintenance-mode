<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Davidpiesse\NovaMaintenanceMode\MaintenanceMode;


Route::post('up', function (Request $request) {
    MaintenanceMode::up();

    return response([
        'message' =>'Application is now live',
        'currentlyInMaintenance' => app()->isDownForMaintenance(),
    ], 200);
});

Route::post('down', function (Request $request) {
    MaintenanceMode::down($request);

    return response([
        'message' =>'Application is now in maintenance mode',
        'currentlyInMaintenance' => app()->isDownForMaintenance(),
    ], 200);
});