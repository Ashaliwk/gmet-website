<?php
/**
 * resources/views/backend/blog_create.blade.php
 * Admin form to create a new blog post (placed directly under backend views)
 */
?>
@extends('backend.layouts.main')

@section('title', 'Add New Blog')

@section('main-container')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Blog</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
        </div>
        <div class="form-group mt-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="image">Featured Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-success mt-4">
            <i class="fas fa-save"></i> Save Blog
        </button>
        <a href="{{ route('admin.blogs') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
    </form>
</div>
@endsection
