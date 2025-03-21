<?php

use App\Console\Kernel;
use App\Models\News;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    app(Kernel::class)->dashboard();
    app(Kernel::class)->sumNewsContent();
    app(Kernel::class)->newsCount();
    app(Kernel::class)->videoDuration();   
    app(Kernel::class)->archiveNews();   
    app(Kernel::class)->teroNews();   
})->everyMinute();
