<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpDepsController;
use App\Http\Controllers\Api\EmpPositionsController;
use App\Http\Controllers\Api\EmpImagesController;
use App\Http\Controllers\Api\EmpListsController;


Route::ApiResource('empDeps', EmpDepsController::class);
Route::ApiResource('empPositions', EmpPositionsController::class);
Route::ApiResource('empImages', EmpImagesController::class);
Route::ApiResource('empLists', EmpListsController::class);
