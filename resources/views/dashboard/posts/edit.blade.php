@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
  </div>

  <div class="col-lg-8">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" id="title" name="title">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $post->slug) }}" id="slug" name="slug" required>
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="hidden" name="oldImage" value="{{ $post->img }}">
            @if ($post->img)
            <img src="{{ asset('storage/' . $post->img) }}" id="imgPreview" class="img-preview img-fluid mb-3 col-sm-6 d-block" style="display: none;">
            @else 
            <img id="imgPreview" class="img-preview img-fluid mb-3 col-sm-6" style="display: none;">
            @endif
            <input type="file" class="form-control @error('img') is-invalid @enderror" 
                   value="{{ old('img') }}" 
                   id="img" 
                   name="img" 
                   onchange="imagePreview()">
            @error('img')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $c)
                @if (old('category_id', $post->category_id) == $c->id)
                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label" >Body</label>
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" >Update</button>
    </form>
  </div>

  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    function imagePreview() {
    const img = document.querySelector('#img');
    const imgPreview = document.querySelector('#imgPreview'); // Perbaikan querySelector

    if (img.files && img.files[0]) {
        const oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.style.display = 'block';
            imgPreview.src = oFREvent.target.result;
        }
    }
}
  </script>
@endsection