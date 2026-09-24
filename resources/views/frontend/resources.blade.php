@extends('frontend.layouts.master')
@section('title', 'Equipment & Software')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Equipment &amp; Software</span>
    <h1>Technical resources &amp; field equipment</h1>
    <p>
      The profile highlights the software and equipment used to support GMET
      geospatial and engineering work.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Softwares</span>
        <h2>Software capabilities</h2>
      </div>
      <div class="software-cloud reveal">
        <span>Python</span><span>ArcGIS</span><span>ArcGIS Pro</span
        ><span>QGIS</span><span>Google Earth Engine</span
        ><span>HEC-RAS</span><span>MATLAB</span><span>ENVI</span
        ><span>ERDAS IMAGINE</span><span>R</span
        ><span>TerraSync Professional</span>
      </div>
      <div class="profile-page-image mt-5 reveal">
        <img
          src="{{ asset('assets/profile-pages/page-14.jpg') }}"
          alt="GMET software profile page"
        />
      </div>
    </div>
  </section>
  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Equipments</span>
        <h2>Surveying, sensing &amp; field equipment</h2>
      </div>
      <div class="equipment-grid">
        <div class="equipment-item">Garmin GPSMAP 67</div>
        <div class="equipment-item">Total Station</div>
        <div class="equipment-item">GeoFennel Auto Level Model GFE-32</div>
        <div class="equipment-item">GPS Trimble Juno 5D</div>
        <div class="equipment-item">TerraSync Professional</div>
        <div class="equipment-item">TUF Lasers DAL32 Digital Level 32X</div>
        <div class="equipment-item">Tromino</div>
        <div class="equipment-item">Ground Penetrating Radar (GPR)</div>
        <div class="equipment-item">Spectroradiometer</div>
        <div class="equipment-item">Drones</div>
        <div class="equipment-item">RC Video Ground Control Station</div>
        <div class="equipment-item">GNSS Field Controller</div>
        <div class="equipment-item">Gravitymeter / Terrameter DDC-8</div>
      </div>
      <div class="row g-4 mt-4">
        <div class="col-md-6">
          <div class="profile-page-image reveal">
            <img
              src="{{ asset('assets/profile-pages/page-26.jpg') }}"
              alt="GMET equipment page 26"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-page-image reveal">
            <img
              src="{{ asset('assets/profile-pages/page-27.jpg') }}"
              alt="GMET equipment page 27"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
