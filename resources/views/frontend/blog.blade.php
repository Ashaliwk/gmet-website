```blade
@extends('frontend.layouts.master')
@section('title', 'Blog')
@section('content')
<header class="page-head">
    <div class="container">
        <span class="eyebrow light">GMET Insights</span>
        <h1>Insights, Innovation & Geo Intelligence</h1>
        <p>Explore the latest insights, trends, and ideas shaping the future of GIS, remote sensing, geospatial technology, and intelligent mapping.</p>
    </div>
</header>

<div class="container py-5 text-center">
    <div class="mb-4">
        <span class="eyebrow">Our Blog</span>
        <h2 class="blog-section-title">Explore Our Latest Insights</h2>
    </div>

    @if($blogs->isEmpty())
        <p class="text-muted">No blog posts have been published yet.</p>
    @else
        <div class="row g-4 mt-4">
            @foreach($blogs as $blog)
                <div class="col-md-4">
                    <div class="card blog-card h-100 shadow-sm">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="blog-title">{{ $blog->title }}</h5>
                            <p class="blog-excerpt">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                        </div>
                        <div class="card-footer blog-footer">
                            {{ $blog->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection

<style>
.blog-section-title {
    margin-top: 8px;
    margin-bottom: 8px;
    font-size: 32px;
    font-weight: 700;
    color: #183b3a;
}

.blog-section-description {
    max-width: 700px;
    margin-bottom: 0;
    color: #667575;
    font-size: 15px;
    line-height: 1.7;
}

.blog-card {
    border: 1px solid #e5eceb;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    transition: all 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(24, 59, 58, 0.1) !important;
}

.blog-image {
    width: 100%;
    height: 210px;
    object-fit: cover;
}

.blog-title {
    margin-bottom: 10px;
    color: #183b3a;
    font-size: 20px;
    font-weight: 700;
    line-height: 1.4;
}

.blog-excerpt {
    margin-bottom: 0;
    color: #687878;
    font-size: 14px;
    line-height: 1.7;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-footer {
    padding: 12px 20px;
    border-top: 1px solid #edf1f0;
    background: #fafcfc;
    color: #7a8888;
    font-size: 13px;
}

@media (max-width: 767px) {
    .blog-section-title {
        font-size: 26px;
    }

    .blog-image {
        height: 200px;
    }

    .blog-title {
        font-size: 18px;
    }
}
</style>
```
