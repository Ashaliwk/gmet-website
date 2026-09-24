@extends('frontend.layouts.master')
@section('title', 'Partners & Clients')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light"
      >Our Valued Clients &amp; Business Partners</span
    >
    <h1>Trusted relationships across sectors</h1>
    <p>
      The profile presents GMET clients and strategic business partners
      supporting technology, engineering, cybersecurity, GIS, and
      development initiatives.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Our Valued Clients</span>
        <h2>Client relationships</h2>
      </div>
      <div class="profile-page-image reveal">
        <img
          src="{{ asset('assets/profile-pages/page-9.jpg') }}"
          alt="GMET valued clients"
        />
      </div>
    </div>
  </section>
  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Our Business Partners</span>
        <h2>Strategic partnerships</h2>
      </div>
      <div class="row g-4">
        @forelse($partners as $partner)
        <div class="col-lg-4 reveal">
          <div class="partner-card h-100">
            <h3>{{ $partner->name }}</h3>
            <p>{{ $partner->description }}</p>
            @if($partner->website)
            <div class="mt-3">
              <a href="{{ $partner->website }}" target="_blank" class="text-link small" rel="noopener">Visit Website →</a>
            </div>
            @endif
          </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
          No business partners listed yet.
        </div>
        @endforelse
      </div>
      <div class="profile-page-image mt-5 reveal">
        <img
          src="{{ asset('assets/profile-pages/page-10.jpg') }}"
          alt="GMET business partners profile page"
        />
      </div>
    </div>
  </section>
</main>
@endsection
