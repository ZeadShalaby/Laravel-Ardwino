<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/arduino', function (\Illuminate\Http\Request $request) {
    Storage::append("arduino-log.txt",
        "Time: " . now()->format("Y-m-d H:i:s") . ', ' .
        "Temperature: " . $request->get("temperature", "n/a") . '°C, ' .
        "Humidity: " . $request->get("humidity", "n/a") . '%'
    );
    $msg = "Add in file arduino-log.txt :)... ";
    return response()->json([
        'status' => true,
        'errNum' => "S000",
        'msg' => $msg
    ]);
});

Route::post('/arduino/second', function (\Illuminate\Http\Request $request) {


if(!empty($request->sendval) && !empty($request->sendval2) )
{
	$temprature = $request->sendval;
	$humidity  = $request->sendval2;
     
    Storage::append("arduino-log2.txt",
    "Time: " . now()->format("Y-m-d H:i:s") . ', ' .
    "Temperature: " . $temprature . '°C, ' .
    "Humidity: " . $humidity . '%'
    );
    $msg = "Add in file arduino-log2.txt :)... ";
    return response()->json([
        'status' => true,
        'errNum' => "S000",
        'msg' => $msg
    ]);
}
else{
    return response()->json([
        'status' => false,
        'errNum' => "E000",
        'msg' => "faild"
    ]);
}
});

Route::get('/arduino/json', function (\Illuminate\Http\Request $request) {

    $file = file_get_contents(public_path('ardwinoget.json'));
    $jsonData = json_decode($file, true);
    return $jsonData;

});
