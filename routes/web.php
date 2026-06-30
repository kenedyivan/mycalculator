<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('calculator', [
        'operation' => 'add',
        'a' => '',
        'b' => '',
        'result' => null,
    ]);
});

Route::post('/calculate', function (Request $request) {
    $validated = $request->validate([
        'a' => ['required', 'numeric'],
        'b' => ['required', 'numeric'],
        'operation' => ['required', 'in:add,subtract,multiply,divide'],
    ]);

    $a = (float) $validated['a'];
    $b = (float) $validated['b'];
    $operation = $validated['operation'];

    $result = match ($operation) {
        'add' => $a + $b,
        'subtract' => $a - $b,
        'multiply' => $a * $b,
        'divide' => $b == 0.0 ? 'Cannot divide by zero' : $a / $b,
    };

    return view('calculator', compact('operation', 'a', 'b', 'result'));
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app' => config('app.name'),
        'time' => now()->toISOString(),
    ]);
});
