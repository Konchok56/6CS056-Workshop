<?php

use App\Http\Controllers\DebugController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 5.1 The default route
Route::get('/', function () {
    return view('welcome');
});

// 5.2 Closure route returning a string
// 6.1 dd() was used here, then removed in 6.5 (Clean Up)
Route::get('/hello', function () {
    // dd('This is the /hello route');
    return 'Hello, Laravel!';
});

// 5.3 Route that returns a view (the view is created in Section 7)
Route::get('/about', function () {
    return view('about');
});

// 5.4 / 5.5 Route with an optional parameter (replaces /greet/{name})
Route::get('/greet/{name?}', function (string $name = 'Guest') {
    return 'Hello, ' . $name . '!';
});

// 6.2 dd() with the Request object: visit /debug?name=Ram&age=22
Route::get('/debug', function (Request $request) {
    // dd($request->all());
    return $request->all();
});

// 6.3 dd() inside a controller
Route::get('/debug-controller', [DebugController::class, 'index']);
