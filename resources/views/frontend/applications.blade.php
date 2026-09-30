@extends('frontend.layouts.master')
@section('title', 'Projects')

@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Completed Projects</span>
    <h1>Interactive Systems & Digital Geospatial Solutions</h1>
    <p>
      Explore our operational GIS Projects, analytical platforms, GeoAI dashboards, and spatial decision systems designed and built by GMET.
    </p>
  </div>
</header>

<main class="applications-page-wrapper">
  <section class="section">
    <div class="container">
      <div class="section-heading reveal text-center mb-5">
        <span class="eyebrow">Our Portfolio</span>
        <h2>Completed Projects</h2>
        <p class="mx-auto" style="max-width: 760px;">
          Select any project below to register and access the operational dashboard or tool. Once registered with a valid email, you will immediately move to the application.
        </p>
      </div>

      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <!-- Applications Cards Grid -->
      <div class="row g-4">
        @forelse($applications as $app)
        <div class="col-lg-4 col-md-6 reveal">
          <div class="application-card h-100 d-flex flex-column" onclick="window.location.href='{{ url('/applications/'.$app->id.'/register') }}'">

            <!-- Card Header / Image or Banner -->
            <div class="app-card-media position-relative">
              @if($app->image_url)
                <img src="{{ $app->image_url }}" alt="{{ $app->title }}" class="app-card-img img-fluid">
              @else
                <div class="app-card-placeholder">
                  <i class="fas fa-laptop-code"></i>
                </div>
              @endif

              <!-- Application Number Badge -->
              <span class="app-number-badge">
                <i class="fas fa-hashtag me-1"></i>{{ $app->display_number }}
              </span>

              @if($app->category)
              <span class="app-category-badge">
                {{ $app->category }}
              </span>
              @endif
            </div>

            <!-- Card Body -->
            <div class="app-card-body p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="app-status-indicator">
                  <span class="status-dot"></span> Operational Application
                </span>
                @if($app->technology)
                <small class="app-tech-pill">{{ $app->technology }}</small>
                @endif
              </div>

              <h3 class="app-title mb-2">{{ $app->title }}</h3>

              <p class="app-description text-muted flex-grow-1">
                {{ Str::limit(strip_tags($app->description), 160) }}
              </p>

              <!-- Card Action Button: Single dedicated button -->
              <div class="app-card-footer pt-3 mt-auto border-top">
                <a href="{{ url('/applications/'.$app->id.'/register') }}"
                   class="btn btn-gmet-action w-100"
                   onclick="event.stopPropagation();">
                  <i class="fas fa-user-plus me-2"></i> Register for Access
                </a>
              </div>
            </div>

          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <div class="empty-apps-state p-5 rounded-4 border">
            <i class="fas fa-laptop-code fa-3x text-muted mb-3"></i>
            <h4 class="text-dark fw-bold">Applications Being Configured</h4>
            <p class="text-muted mb-0">Our application portfolio is currently being updated. Please check back soon!</p>
          </div>
        </div>
        @endforelse
      </div>

    </div>
  </section>
</main>

@push('styles')
<style>
  /* ==========================================================
     GMET Applications Page Styles (Light & Dark Mode)
     ========================================================== */
  .applications-page-wrapper {
    min-height: 70vh;
  }

  .application-card {
    background: #ffffff;
    border: 1px solid #dfe8dc;
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-shadow: 0 4px 18px rgba(18, 59, 29, 0.05);
    cursor: pointer;
  }

  .application-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(18, 59, 29, 0.12);
    border-color: #9ecc98;
  }

  .app-card-media {
    height: 190px;
    background: linear-gradient(135deg, #123b1d, #1f5d2b);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }

  .app-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .application-card:hover .app-card-img {
    transform: scale(1.05);
  }

  .app-card-placeholder {
    font-size: 3.5rem;
    color: rgba(255, 255, 255, 0.28);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
  }

  .app-number-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(12, 38, 19, 0.88);
    color: #edf5ea;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 50rem;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  .app-category-badge {
    position: absolute;
    bottom: 14px;
    right: 14px;
    background: rgba(255, 255, 255, 0.92);
    color: #123b1d;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 50rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  }

  .app-status-indicator {
    font-size: 0.78rem;
    font-weight: 600;
    color: #1f5d2b;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .status-dot {
    width: 8px;
    height: 8px;
    background: #28a745;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.25);
    animation: pulseDot 2s infinite;
  }

  @keyframes pulseDot {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.5); }
    70% { box-shadow: 0 0 0 6px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
  }

  .app-tech-pill {
    background: #eef5ea;
    color: #1f5d2b;
    font-size: 0.72rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 4px;
  }

  .app-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #123b1d;
    line-height: 1.35;
  }

  .app-description {
    font-size: 0.92rem;
    line-height: 1.6;
    color: #556658 !important;
  }

  .btn-gmet-action {
    background: #1f5d2b;
    color: #ffffff !important;
    font-weight: 600;
    font-size: 0.92rem;
    padding: 10px 18px;
    border-radius: 50rem;
    border: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(31, 93, 43, 0.2);
    display: block;
    text-align: center;
  }

  .btn-gmet-action:hover {
    background: #123b1d;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(18, 59, 29, 0.3);
    color: #ffffff !important;
  }

  /* ==========================================================
     DARK THEME SUPPORT FOR APPLICATIONS PAGE
     ========================================================== */
  body.dark .application-card {
    background: #122017;
    border-color: #263b2a;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  }

  body.dark .application-card:hover {
    border-color: #4a7552;
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.45);
  }

  body.dark .app-title {
    color: #edf5ea;
  }

  body.dark .app-description {
    color: #aebaae !important;
  }

  body.dark .app-card-footer {
    border-color: #263b2a !important;
  }

  body.dark .app-category-badge {
    background: #1f3825;
    color: #bfe5b6;
    border: 1px solid #33593a;
  }

  body.dark .app-status-indicator {
    color: #8ed382;
  }

  body.dark .app-tech-pill {
    background: #1a3320;
    color: #bfe5b6;
  }

  body.dark .empty-apps-state {
    background: #122017;
    border-color: #263b2a !important;
  }

  body.dark .empty-apps-state h4 {
    color: #edf5ea !important;
  }
</style>
@endpush
@endsection
