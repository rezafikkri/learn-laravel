@extends('layouts.main')

@section('content')
    <h1>Halaman About</h1>
    <h3>{{ $nama }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $nama }}">
@endsection
