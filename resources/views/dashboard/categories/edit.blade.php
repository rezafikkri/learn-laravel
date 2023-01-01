@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
</div>

<div class="col-lg-8 mb-5">
    <form action="/dashboard/categories/{{ $category->slug }}" method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus required value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly required value="{{ old('slug', $category->slug) }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a class="btn btn-outline-secondary me-2" href="{{ route('categories.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
<script>
const categoryElement = document.querySelector('#name');
const slugElement = document.querySelector('#slug');

categoryElement.addEventListener('change', () => {
    fetch('/dashboard/categories/checkSlug?category=' + categoryElement.value)
        .then((response) => response.json())
        .then((data) => slugElement.value = data.slug);
});
</script>
@endsection