@extends('dashboard.layouts.main')

@section('content')
<div class="row my-4">
    <div class="col-lg-8">
        <h2>{{ $post->title }}</h2>
        <a href="/dashboard/posts" class="btn btn-success btn-sm me-1">Back to all my posts <span data-feather="arrow-left"></span></a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning btn-sm me-1">Edit <span data-feather="edit"></span></a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete <span data-feather="x-circle"></span></button>
        </form>

        @if ($post->image)
            <img src="{{ asset('img/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" style="height: 350px; width: 100%; object-fit: cover;">
        @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
        @endif

        <article class="my-3 fs-5">{!! $post->body !!}</article>
    </div>
</div>
@endsection
