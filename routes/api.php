<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ardwino', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Storage::append("arduino-log.txt",
        "Time: " . now()->format("Y-m-d H:i:s") . ', ' .
        "Temperature: " . $request->get("temperature", "n/a") . '°C, ' .
        "Humidity: " . $request->get("humidity", "n/a") . '%'
    );
});