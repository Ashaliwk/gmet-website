@extends('frontend.layouts.master')
@section('title', 'About')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">About GMET</span>
    <h1>Shaping Tomorrow Through Geo Intelligence</h1>
    <p>Innovating Today • Engineering Tomorrow • Mapping the Future</p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-8 reveal">
          <span class="eyebrow">About Us</span>
          <h2>Geo Mapping Engineering &amp; Technologies</h2>
          <p class="lead">
            Geo Mapping Engineering &amp; Technologies (GMET) delivers premier
            geospatial and engineering solutions, empowering government,
            private, and development sectors with actionable spatial
            intelligence.
          </p>
          <p>
            Our expertise spans GIS, remote sensing, advanced surveying, UAV
            and drone mapping, and geomatics. By integrating AI-driven
            design, precision engineering, web GIS and cloud mapping, and
            structural innovation, we transform complex data into
            customized, cost-effective strategies.
          </p>
          <p>
            We drive sustainable development and operational success through
            cutting-edge digital mapping, spatial analysis, infrastructure
            planning, asset management, and environmental monitoring.
          </p>
        </div>
        <div class="col-lg-4 reveal">
          <div class="profile-quote">
            <strong>Profile tagline</strong>
            <p>Turning Data, Technology &amp; Ideas into Impact</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="ceo" class="section section-tint">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-4 text-center reveal">
          <div class="ceo-photo-wrap">
            <img
              src="{{ asset('assets/images/ceo-abida-parveen.png') }}"
              alt="Mrs. Abida Parveen"
            />
          </div>
          <h3 class="mt-4">Mrs. Abida Parveen</h3>
          <p class="role">Chief Executive Officer</p>
        </div>
        <div class="col-lg-8 reveal">
          <span class="eyebrow">CEO Message</span>
          <h2>Transforming geospatial intelligence into impact.</h2>
          <div class="quote-box">
            <p>
              With over 15 years in geospatial technology, I've led
              transformative projects across the region including
              Bangladesh's first navigation system and Pakistan's first
              Cadastral Mapping of State Lands Project, along with
              religious-site mapping and web-based GIS initiatives.
            </p>
            <p>
              This journey convinced me that geospatial technology's
              potential is limited only by our imagination. That belief led
              me to found Geo Mapping Engineering &amp; Technologies (GMET) in
              2025 to turn geospatial intelligence into practical,
              measurable impact.
            </p>
            <p>
              Pakistan holds immense potential for geospatial innovation,
              yet gaps remain in spatial data collection, analysis, and
              accessibility. At GMET, we bridge these gaps through GIS,
              surveying, remote sensing, geomatics, and engineering
              solutions that drive smarter, sustainable decision-making.
            </p>
            <p class="mb-0">
              Guided by innovation, collaboration, integrity, and
              excellence, our goal isn't just to map the world but to
              understand it, connect it, and help shape its future.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Organizational Structure</span>
        <h2>How GMET is structured</h2>
      </div>
      <div class="profile-page-image reveal">
        <img
          src="{{ asset('assets/profile-pages/page-5.jpg') }}"
          alt="GMET organizational structure from company profile"
        />
      </div>
    </div>
  </section>
  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Vision &amp; Mission</span>
        <h2>Our Philosophy and Mission</h2>
      </div>
      <div class="row g-4">
        <div class="col-lg-6 reveal">
          <div class="info-panel">
            <span class="eyebrow">Our Philosophy / Vision</span>
            <p>
              To become the trusted global partner for geospatial
              innovation, delivering intelligent engineering solutions that
              inspire progress, drive sustainability, and shape the future.
            </p>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <div class="info-panel">
            <span class="eyebrow">Our Mission</span>
            <p>
              To empower organizations with precise geospatial intelligence,
              advanced engineering, and innovative technologies for enhanced
              decision-making and sustainable growth.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Our Core Values</span>
        <h2>Innovation • Collaboration • Integrity • Excellence</h2>
      </div>
      <div class="profile-page-image reveal">
        <img
          src="{{ asset('assets/profile-pages/page-7.jpg') }}"
          alt="GMET core values page"
        />
      </div>
    </div>
  </section>
  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Registration &amp; Certification</span>
        <h2>Professional credentials</h2>
      </div>
      <div class="profile-page-image reveal">
        <img
          src="{{ asset('assets/profile-pages/page-8.jpg') }}"
          alt="GMET registration and certification page"
        />
      </div>
    </div>
  </section>
</main>
@endsection
