<?php
/**
 * resources/views/backend/blog_edit.blade.php
 * Admin form to edit an existing blog post (placed directly under backend views)
 */
?>
@extends('backend.layouts.main')

@section('title', 'Edit Blog')

@section('main-container')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Blog</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $blog->title) }}">
        </div>
        <div class="form-group mt-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="image">Featured Image (optional)</label>
            @if($blog->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="height:80px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-success mt-4">
            <i class="fas fa-save"></i> Update Blog
        </button>
        <a href="{{ route('admin.blogs') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
    </form>
</div>
@endsection
