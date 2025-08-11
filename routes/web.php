<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', function () {
    return redirect(Filament::getLoginUrl());
});