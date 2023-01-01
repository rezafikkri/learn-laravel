@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>

<div class="col-lg-8 mb-5">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus required value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly required value="{{ old('slug', $post->slug) }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == old('category_id', $post->category_id)) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
            @if ($post->image)
                <img src="{{ asset($post->image) }}" alt="{{ $post->image }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @endif
            <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            @error('body')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body"></trix-editor>
        </div>
        <a class="btn btn-outline-secondary me-2" href="{{ route('posts.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<script>
const titleElement = document.querySelector('#title');
const slugElement = document.querySelector('#slug');

titleElement.addEventListener('change', () => {
    fetch('/dashboard/posts/checkSlug?title=' + titleElement.value)
        .then((response) => response.json())
        .then((data) => slugElement.value = data.slug);
});

document.addEventListener('trix-file-accept', (e) => e.preventDefault());

const inputImageElement = document.querySelector('input#image');
inputImageElement.addEventListener('change', (e) => {
    const ofReader = new FileReader();

    // if image preview element exist
    let imageElement = e.target.parentElement.querySelector('.img-preview');
    if (imageElement) {
        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = (ofReader) => {
            imageElement.src = ofReader.target.result;
            imageElement.alt = e.target.files[0].name;
        }
    } else {
        imageElement = document.createElement('img');
        imageElement.setAttribute('class', 'img-preview img-fluid mb-3 col-sm-5 d-block');

        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = (ofReader) => {
            imageElement.src = ofReader.target.result;
            imageElement.alt = e.target.files[0].name;

        }

        e.target.parentElement.insertBefore(imageElement, e.target);
    }
});
</script>
@endsection
