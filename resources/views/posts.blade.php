@extends('layouts.main')

@section('container')
<div class="container ">
    <div class="row align-items-center mb-3">
        <!-- Brand -->
        <div class="col-md-6">
            <h3>{{ $title }}</h3>
        </div>
        
        <!-- Search Bar -->
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mau nyari apa? ..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>



@if ($posts->count())
    <div class="card mb-3">
        {{-- Gunakan $imageUrl sebagai sumber gambar --}}
        @if ($posts[0]->img)
        <img src="{{ asset('storage/' . $posts[0]->img) }}"
        class="card-img-top img-fluid" alt="{{ $posts[0]->category->name }}" style="width: 100% !important; height: 400px; object-fit: cover;">
        @else
        <img src="/img/default.jpg"
        class="card-img-top img-fluid" alt="{{ $posts[0]->category->name }}" style="width: 100% !important; height: 350px; object-fit: cover;">
        @endif
        <div class="card-body text-center">
            <h3 class="card-title">
                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">
                    {{ $posts[0]->title }}
                </a>
            </h3>
            <p>
                <small class="text-muted">
                    By <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">
                        {{ $posts[0]->author->name }}
                    </a> in 
                    <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">
                        {{ $posts[0]->category->name }}
                    </a> 
                    {{ $posts[0]->created_at->diffForHumans() }}
                </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>
            <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Readmore</a>
        </div>
    </div>

    
    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if ($post->img)
                    <img src="{{ asset('storage/' . $post->img) }}"
                    class="card-img-top img-fluid" 
                         alt="{{ $post->category->name }}" 
                         style="height: 200px; object-fit: cover;">
                    @else
                    <img src="/img/default.jpg"
                    class="card-img-top img-fluid" 
                         alt="{{ $post->category->name }}" 
                         style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p>
                            <small class="text-muted">
                                By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">
                                    {{ $post->author->name }}
                                </a>
                                {{ $post->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/post/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Readmore</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <p class="text-center fs-4">No Post Found.</p>
    @endif
    
    <div class="d-flex justify-content-center">
    {{ $posts->links() }}
    </div>

@endsection