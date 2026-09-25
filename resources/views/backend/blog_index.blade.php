<?php
/**
 * resources/views/backend/blog_index.blade.php
 * Admin list view for Blog posts (moved from backend/blogs folder)
 */
?>
@extends('backend.layouts.main')

@section('title', 'Blog Management')

@section('main-container')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Blog Posts</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Blog
    </a>
    @if($blogs->isEmpty())
        <p>No blog posts found.</p>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration + ($blogs->currentPage() - 1) * $blogs->perPage() }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="height:60px;">
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this blog post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    @endif
</div>
@endsection
