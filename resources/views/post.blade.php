@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <h3 class="mb-3">{{ $post->title }}</h3>
            <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none"> {{ $post->category->name }}</a></p>

            @if ($post->img)
            <img src="{{ asset('storage/' . $post->img) }}"
            class="card-img-top img-fluid" alt="{{ $post->category->name }}" style="width: 100% !important; height: 350px; object-fit: cover;">
            @else
            <img src="/img/default.jpg"
            class="card-img-top img-fluid" alt="{{ $post->category->name }}" style="width: 100% !important; height: 350px; object-fit: cover;">
            @endif

            <article class="my-3 fs-6">
                {!! $post->body !!}
            </article>

            <br>
            <hr>
            <a href="/posts" class="btn btn-primary text-decoration-none">back to post</a>
        </div>
    </div>
</div>
@endsection

