@extends('frontend.layouts.master')
@section('title', 'Meet Our Team')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Meet Our Team</span>
    <h1>People behind the geospatial work</h1>
    <p>
      Technical, analytical, management, environmental, and Web GIS
      expertise across the GMET team.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Our Team</span>
        <h2>Meet Our Expert Team</h2>
      </div>
      <div class="row g-4">
        @forelse($team as $member)
        <div class="col-md-6 col-xl-4 reveal">
          <article class="team-card">
            <div class="team-img-wrap">
              @if($member->image && file_exists(public_path('assets/images/' . $member->image)))
              <img
                src="{{ asset('assets/images/' . $member->image) }}"
                alt="{{ $member->fullname }}" />
              @elseif($member->image && file_exists(public_path('uploads/team/' . $member->image)))
              <img
                src="{{ asset('uploads/team/' . $member->image) }}"
                alt="{{ $member->fullname }}" />
              @else
              <img
                src="{{ asset('assets/images/gmet-logo.jpeg') }}"
                alt="{{ $member->fullname }}" />
              @endif
            </div>
            <div class="team-meta">
              <h3>{{ $member->fullname }}</h3>
              <span>{{ $member->designation }}</span>
              <p>{{ $member->intro }}</p>
            </div>
          </article>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">No team members published yet.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>
</main>
@endsection