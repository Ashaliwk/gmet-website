@extends('frontend.layouts.master')
@section('title', 'Completed Projects')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Completed Projects</span>
    <h1>From agreements to practical results</h1>
    <p>
      The GMET profile records completed work and active project
      agreements/purchase orders.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="section-heading reveal">
        <span class="eyebrow">Project Summary</span>
        <h2>Precision, innovation, and professional excellence.</h2>
        <p>
          Our projects reflect GMET's commitment to turning expertise into
          practical solutions and delivering results that create lasting
          value for clients and partners.
        </p>
      </div>
      <div class="table-responsive project-table reveal">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Project / Description</th>
              <th>Document</th>
              <th>Date / Timeline</th>
              <th>Key Terms</th>
            </tr>
          </thead>
          <tbody>
            @forelse($projects as $project)
            <tr>
              <td><strong>{{ $loop->iteration }}</strong></td>
              <td>{{ $project->client }}</td>
              <td>{{ $project->title }}</td>
              <td>{{ $project->document ?: '—' }}</td>
              <td>{{ $project->timeline ?: '—' }}</td>
              <td>{{ $project->key_terms ?: '—' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">No projects recorded yet.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

  @if(isset($featuredProjects) && count($featuredProjects) > 0)
  <section class="section section-tint">
    <div class="container">
      <div class="row g-4">
        @foreach($featuredProjects as $fIndex => $featured)
        <div class="col-md-4">
          <div class="stat-card">
            <span>0{{ $loop->iteration }}</span>
            <h3>{{ $featured->client }}</h3>
            <p>{{ $featured->title }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Project Profile Pages</span>
        <h2>Project documentation from the GMET profile</h2>
        <p>
          The remaining project pages in the supplied profile are preserved
          below as visual reference pages.
        </p>
      </div>
      <div class="row g-4">
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-19.jpg') }}"
              alt="GMET completed projects profile page 19"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-20.jpg') }}"
              alt="GMET completed projects profile page 20"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-21.jpg') }}"
              alt="GMET completed projects profile page 21"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-22.jpg') }}"
              alt="GMET completed projects profile page 22"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-23.jpg') }}"
              alt="GMET completed projects profile page 23"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-24.jpg') }}"
              alt="GMET completed projects profile page 24"
            />
          </div>
        </div>
        <div class="col-md-6 reveal">
          <div class="profile-page-image">
            <img
              src="{{ asset('assets/profile-pages/page-25.jpg') }}"
              alt="GMET completed projects profile page 25"
            />
          </div>
        </div>
      </div>
    </div>
  </section> -->
</main>
@endsection
