<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-data', [ApiController::class, 'fetchData']);
Route::get('/fetch-second-api', [ApiController::class, 'fetchSecondApi']);

Route::get('/assign-tasks', [TaskController::class, 'assignTasks']);