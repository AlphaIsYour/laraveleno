@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-10">
            <h2 class="mb-3">{{ $post->title }}</h2>
            
            <a href="/dashboard/posts" class="btn btn-info border-0"><span data-feather="arrow-left"></span> Back to posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning border-0"><span data-feather="edit"></span></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('are you sure about that?')"><span  data-feather="trash-2"></span></button>
              </form>

            @if ($post->img)
            <img src="{{ asset('storage/' . $post->img) }}"
            class="card-img-top img-fluid mt-3" alt="{{ $post->category->name }}" style="width: 100% !important; height: 350px; object-fit: cover;">
            @else
            <img src="/img/default.jpg"
            class="card-img-top img-fluid mt-3" alt="{{ $post->category->name }}" style="width: 100% !important; height: 350px; object-fit: cover;">
            @endif

            <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none"> {{ $post->category->name }}</a></p>

            <article class="my-3 fs-6">
                {!! $post->body !!}
            </article>

            <br>
            <hr>
            <a href="/dashboard/posts" class="btn btn-primary text-decoration-none">back to post</a>
        </div>
    </div>
</div>
@endsection