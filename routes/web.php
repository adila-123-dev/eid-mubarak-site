<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

// Main page — log visitor on load
Route::get('/', function () {
    app(VisitorController::class)->log(request());
    return view('welcome');
});

// API routes (also works in web.php for simplicity)
Route::prefix('api')->group(function () {

    // Get all visitors list + stats
    Route::get('/visitors', [VisitorController::class, 'index']);

    // Log a celebration tap
    Route::post('/tap', [VisitorController::class, 'tap']);

    // Log a wish sent
    Route::post('/wish', [VisitorController::class, 'wish']);

});

Route::get('/admin-visitors', function () {

    return \App\Models\Visitor::latest()
        ->limit(100)
        ->get();

});
