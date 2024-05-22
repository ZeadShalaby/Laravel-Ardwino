<?php

use App\Models\ArduinoLog;
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



// ? insert data in database
Route::post('/arduino', function (Request $request) {

    $arduino = ArduinoLog::create([
        'temperature'  => $request->temperature,
        'humidity' =>$request->humidity,
        'co' =>$request->co,
        'co2' =>$request->co2,
    ]);
    
    $msg = "Data saved successfully in the database.";
    return response()->json([
        'status' => true,
        'errNum' => "S000",
        'msg' => $msg
    ]);
});


// ? insert data in file 
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

// ? return all data in this file
Route::get('/arduino/json', function (\Illuminate\Http\Request $request) {

    $file = file_get_contents(public_path('ardwinoget.json'));
    $jsonData = json_decode($file, true);
    return $jsonData;

});

// ? return one element by id
Route::get('/arduino/json/{id}', function (\Illuminate\Http\Request $request) {

    $file = file_get_contents(public_path('ardwinoget.json'));
    $jsonData = json_decode($file, true);
    
    return $request-> id;

});

