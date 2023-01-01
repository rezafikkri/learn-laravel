@extends('layouts.main')

@section('content')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/blog">
                <div class="input-group">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
    <div class="card mb-3">
        @if ($posts[0]->image)
            <img src="{{ asset($posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="card-img-top" style="height: 350px; width: 100%; object-fit: cover;">
        @else
            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
        @endif

        <div class="card-body text-center">
            <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
            <small class="text-muted d-inline-block mb-1">
                By. <a href="/blog?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/blog?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
            </small>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>

            <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more..</a>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row">
            @foreach ($posts->skip(1) as $p)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                        <a href="/blog?category={{ $p->category->slug }}" class="text-white text-decoration-none">{{ $p->category->name }}</a>
                    </div>

                    @if ($p->image)
                        <img src="{{ asset($p->image) }}" alt="{{ $p->category->name }}" class="card-img-top">
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $p->category->name }}" class="card-img-top" alt="{{ $p->category->name }}">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title"><a href="/posts/{{ $p->slug }}" class="text-decoration-none text-dark">{{ $p->title }}</a></h5>
                        <small class="text-muted d-inline-block mb-1">
                            By. <a href="/blog?author={{ $p->author->username }}" class="text-decoration-none">{{ $p->author->name }}</a> {{ $p->created_at->diffForHumans() }}
                        </small>
                        <p class="card-text">{{ $p->excerpt }}</p>
                        <a href="/posts/{{ $p->slug }}" class="text-decoration-none btn btn-primary">Read more..</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <p class="text-center fs-4">Not post found</p>
    @endif

    {{ $posts->links() }}
@endsection
