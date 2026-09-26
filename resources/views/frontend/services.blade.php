@extends('frontend.layouts.master')
@section('title', 'Services & Solutions')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Our Services &amp; Solutions</span>
    <h1>Integrated Geospatial &amp; Engineering Services</h1>
    <p>
      A complete portfolio of GIS, remote sensing, surveying, Web GIS,
      GeoAI, engineering, environmental, and infrastructure capabilities.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="row g-4">
        @forelse($services as $service)
        <div class="col-md-6 col-xl-4 reveal">
          <article class="team-card">
            <div class="tcard">
              <img src="{{ $service->image }}"
                alt="{{ $service->title }}"
                class="img-fluid">
            </div>
            <div class="body">
              <h5 class="service-title text-center">{{ $service->title }}</h5>
              <p>{{ $service->description }}</p>
            </div>
          </article>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">No services published yet.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>
  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Software</span>
        <h2>Tools and software</h2>
        <p>
          The profile explicitly identifies Python and presents a software
          section.
        </p>
      </div>
      <div class="software-cloud">
        <span>Python</span><span>ArcGIS</span><span>ArcGIS Pro</span><span>QGIS</span><span>Google Earth Engine</span><span>HEC-RAS</span><span>MATLAB</span><span>ENVI</span><span>ERDAS IMAGINE</span><span>R</span><span>TerraSync Professional</span>
      </div>
    </div>
  </section>
</main>
@endsection