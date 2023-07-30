<?php

use Illuminate\Support\Facades\Route;
use Jonre\Mariteslog\Http\Controllers\MariteslogController;


Route::get('ping', [MariteslogController::class , 'ping'])->name('mariteslog.ping');
Route::get('logs', [MariteslogController::class , 'getLogs'])->name('mariteslog.getLogs');
Route::get('insert', [MariteslogController::class , 'insert'])->name('mariteslog.insert');