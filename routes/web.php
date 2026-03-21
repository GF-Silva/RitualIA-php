<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

function get_music_collections($name) {
    $CLIENT_ID = "fZZystuNmRezJL7O34gUK46UP1FV47Fc";

    $nome = $name;

    $url = 'https://api-v2.soundcloud.com/search/tracks';
    
    $body = [
        'q' => $nome,
        'client_id' => $CLIENT_ID,
        'limit' => 5
    ];

    $response = Http::get($url, $body);
    $data = json_decode( $response->getBody(), true );

    $data_collection = $data["collection"];

    if (!$data_collection) {
        return [];
    }
    
    return $data_collection;
};

Route::get('/', function () {
    return view('homepage');
});

Route::post('/get-music-url', function(Request $request) {
    $name = $request->input('name');

    $collections = get_music_collections($name);

    if (count($collections) == 0) {
        return json_encode([], 404);
    }

    $url = $collections[0]['permalink_url'];

    $resp = json_encode([
        'url'=> $url
    ], 200);

    return $resp;
});