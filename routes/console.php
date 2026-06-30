<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:hello', function () {
    $this->info('Hello from MyCalculator');
});
