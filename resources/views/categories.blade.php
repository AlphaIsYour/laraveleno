@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-6 text-center">
            <h3>Halaman Posts Categories</h3>
        </div>
    </div>
</div>

<br>

<div class="container">
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-3">
            <a href="/posts?category={{ $category->slug }}">
            <div class="card bg-dark text-white">
                <img src="img/default.jpg" 
                     class="card-img" 
                     alt="{{ $category->name }}"
                     style="height: 400px; object-fit: cover;">
                <div class="card-img-overlay d-flex align-items-center p-0">
                    <h5 class="card-title text-center flex-fill p-4 fs-3" 
                        style="background-color: rgba(0,0,0,0.7)">
                        {{ $category->name }}
                    </h5>
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection