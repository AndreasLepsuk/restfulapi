<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ReturnController;

Route::get('/families/{name}/relations', [ReturnController::class, 'showRelations']);
Route::get('/families/bulk', [FamilyController::class, 'bulkStore']);
Route::post('/families/bulk', [FamilyController::class, 'bulkStore']);
