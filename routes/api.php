<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Davidpiesse\NovaMaintenanceMode\Http\Controllers\ToolController;

Route::post('up', ToolController::class.'@up');
Route::post('down', ToolController::class.'@down');
