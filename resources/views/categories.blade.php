@extends('layouts.main')

@section('content')
    <h1 class="mb-5">Posts Categories</h1>

    <div class="row">
        @foreach ($categories as $c)
        <div class="col-md-4">
            <a href="/blog?category={{ $c->slug }}">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x400?{{ $c->name }}" alt="{{ $c->name }}" class="card-img">
                    <div class="card-img-overlay p-0 d-flex align-items-center justify-content-center">
                        <h5 class="card-title flex-fill p-4" style="background-color: rgba(0,0,0,.7)">{{ $c->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
