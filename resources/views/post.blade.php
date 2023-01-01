@extends('layouts.main')

@section('content')
<div class="row justify-content-start mb-4">
    <div class="col-md-8">
        <h2>{{ $post->title }}</h2>
        <small class="text-muted d-block mb-3">By. <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></small>

        @if ($post->image)
            <img src="{{ asset($post->image) }}" alt="{{ $post->category->name }}" class="img-fluid" style="height: 350px; width: 100%; object-fit: cover;">
        @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
        @endif

        <article class="my-3 fs-5">{!! $post->body !!}</article>

        <a href="/blog">Back to Posts</a>
    </div>
</div>
@endsection
