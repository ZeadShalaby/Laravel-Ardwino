<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();




//! check Barter its End or not after daily
//todo call the name of command to run code every day , hourly//
Schedule::command('app:send-emails')->everyTenSeconds();