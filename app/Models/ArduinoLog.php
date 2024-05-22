<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArduinoLog extends Model
{
    use HasFactory;

    protected $fillable = ['timestamp', 'temperature', 'humidity', 'co', 'co2'];
}
