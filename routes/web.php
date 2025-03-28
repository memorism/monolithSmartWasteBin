<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('bins');
});

Route::get('/bins', function () {
    $search = request('search');
    $response = Http::timeout(10)
        ->withoutVerifying()
        ->get('https://67e62f6d6530dbd3110efdce.mockapi.io/smart-waste-bin');

    $bins = collect($response->json());

    if ($search) {
        $bins = $bins->filter(function ($item) use ($search) {
            return str_contains(strtolower($item['location']), strtolower($search));
        });
    }

    return view('bins', compact('bins', 'search'));
});
