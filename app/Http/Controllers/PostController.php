<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index() 
    {
        $title = 'All Posts'; // Kasih nilai default
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Posts in ' . $category->name; // Ganti dari .= jadi =
        }
    
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = 'Posts by ' . $author->name; // Ganti dari .= jadi =
        }
    
        return view('posts', [
            'title' => $title,
            'active' => 'posts',
            'posts' => Post::latest()->filter(request(['author', 'category', 'search']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        $imageUrl = null;
        try {
            $response = Http::get('https://api.unsplash.com/photos/random', [
                'query' => $post->category->name,
                'client_id' => env('UNSPLASH_ACCESS_KEY'),
            ]);
    
            if ($response->successful()) {
                $imageUrl = $response['urls']['regular'];
            }
        } catch (\Exception $e) {
            Log::error('Unsplash API Error: ' . $e->getMessage());
        }
    
        return view('post', [
            'title' => 'Single Post',
            'active' => 'posts',
            'post' => $post->load(['author', 'category']),
            'imageUrl' => $imageUrl
        ]);
    }
    

    public function showCategories(){
        $categories = Category::all();
        $imageUrls = [];
        
        foreach ($categories as $category) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Client-ID gjPJa5gRj4hwQx5eoITS4ValoVpusKX-wlaNl-v4rso'
                ])->get('https://api.unsplash.com/photos/random', [
                    'query' => $category->name
                ]);
                
                if ($response->successful()) {
                    $data = $response->json();
                    $imageUrls[$category->id] = $data['urls']['regular'];
                } else {
                    $imageUrls[$category->id] = 'https://via.placeholder.com/1200x400?text=No+Image+Available';
                }
                
            } catch (\Exception $e) {
                $imageUrls[$category->id] = 'https://via.placeholder.com/1200x400?text=No+Image+Available';
            }
        }
        
        return view('categories', [
            'title' => 'Post Categories',  // Tambahkan title
            'active' => 'categories',      // Tambahkan active menu jika diperlukan
            'categories' => $categories,
            'imageUrls' => $imageUrls
        ]);
    }

}