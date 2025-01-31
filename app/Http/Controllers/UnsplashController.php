<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class UnsplashController extends Controller
{
    public function randomImage($category)
    {
        // Ambil data gambar dari Unsplash API
        $response = Http::get('https://api.unsplash.com/photos/random',[
            'query' => $category,
            'client_id' => env('gjPJa5gRj4hwQx5eoITS4ValoVpusKX-wlaNl-v4rso'), // Gunakan Access Key dari .env
        ]);

        // Periksa apakah respons berhasil
        if ($response->successful()) {
            $imageUrl = $response['urls']['regular']; // URL gambar
            return view('image', compact('imageUrl'));
        } else {
            return back()->withErrors('Gagal memuat gambar.');
        }
    }
}

