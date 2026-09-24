@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
<main>
  <section class="hero">
    <div class="hero-grid"></div>
    <div class="container position-relative">
      <div class="row align-items-center min-vh-100 py-5">
        <div class="col-lg-8 pt-5 reveal">
          <span class="eyebrow light"
            >Turning Data, Technology &amp; Ideas into Impact</span
          >
          <h1>Shaping Tomorrow Through <span>Geo Intelligence.</span></h1>
          <p class="lead">
            Geo Mapping Engineering &amp; Technologies (GMET) delivers premier
            geospatial and engineering solutions for government, private,
            and development sectors.
          </p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            <a href="{{ url('/services') }}" class="btn btn-gmet"
              >Explore Services</a
            ><a href="{{ url('/contact') }}" class="btn btn-outline-gmet"
              >Get In Touch</a
            >
          </div>
          <div class="hero-tags mt-4">
            <span>GIS</span><span>Remote Sensing</span><span>Surveying</span
            ><span>UAV</span><span>Web GIS</span><span>GeoAI</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-7 reveal">
          <span class="eyebrow">About GMET</span>
          <h2>Geospatial intelligence for smarter decisions.</h2>
          <p class="lead">
            GMET empowers government, private, and development sectors with
            actionable spatial intelligence across GIS, remote sensing,
            surveying, UAV mapping, geomatics, engineering, Web GIS, and
            AI-driven solutions.
          </p>
          <p>
            By integrating precision engineering, digital mapping, spatial
            analysis, infrastructure planning, asset management, and
            environmental monitoring, GMET transforms complex data into
            customized, cost-effective strategies.
          </p>
          <a class="text-link" href="{{ url('/about') }}"
            >Read our full profile →</a
          >
        </div>
        <div class="col-lg-5 reveal">
          <div class="feature-panel">
            <div>
              <span class="stat-number">2025</span><span>Founded</span>
            </div>
            <div>
              <span class="stat-number">15+</span
              ><span>Years of CEO's geospatial experience</span>
            </div>
            <div>
              <span class="stat-number">{{ count($services) > 0 ? count($services) : '15' }}</span
              ><span>Services &amp; solution areas</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-tint">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">What We Do</span>
        <h2>Integrated services &amp; solutions</h2>
        <p>
          Explore the capabilities presented in the GMET company profile.
        </p>
      </div>
      <div class="row g-4">
        @forelse($services as $srv)
        <div class="col-md-6 col-lg-4 reveal">
          <div class="mini-service">
            <span>{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</span>
            <h3>{{ $srv->title }}</h3>
            <p>{{ Str::limit($srv->description, 140) }}</p>
          </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">Services being updated.</div>
        @endforelse
      </div>
      <div class="text-center mt-5">
        <a class="btn btn-gmet" href="{{ url('/services') }}"
          >View All Services</a
        >
      </div>
    </div>
  </section>

<section class="why-choose-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-4">
                <div class="why-badge">
                    <span></span>
                    OUR EXCELLENCE
                </div>
                <h2 class="why-title">
                    WHY CHOOSE
                    <br>
                    US
                    <br>
                    <strong>FOR</strong>
                    <br>
                    <strong>PROJECTS!</strong>
                </h2>
                <p class="why-description">
                    We take pride in delivering top-quality spatial
                    solutions that are tailored to meet the unique
                    needs of our clients.
                </p>
                <a href="{{ url('/services') }}" class="why-button">
                    VIEW ALL SERVICES
                </a>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="why-card">
                            <div class="why-icon">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div class="why-card-content">
                                <h3>Client Focused Approach</h3>
                                <p>
                                    Tailored services with a client-first
                                    approach.
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="why-card">
                            <div class="why-icon">
                                <i class="fa-solid fa-hard-hat"></i>
                            </div>
                            <div class="why-card-content">
                                <h3>Timely Deliveries</h3>
                                <p>
                                    On-schedule and quality deliveries for
                                    all projects.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="why-card">
                            <div class="why-icon">
                                <i class="fa-solid fa-desktop"></i>
                            </div>
                            <div class="why-card-content">
                                <h3>Modern Technique</h3>
                                <p>
                                    Innovative GIS solutions with modern
                                    techniques.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="why-card">
                            <div class="why-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="why-card-content">
                                <h3>Experienced Staff</h3>
                                <p>
                                    Highly professional team for exceptional
                                    results.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <section class="section">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-4 text-center reveal">
          <div class="ceo-photo-wrap">
            <img
              src="{{ asset('assets/images/ceo-abida-parveen.png') }}"
              alt="Mrs. Abida Parveen"
            />
          </div>
          <h3 class="mt-4 mb-1">Mrs. Abida Parveen</h3>
          <p class="role">Chief Executive Officer</p>
        </div>
        <div class="col-lg-8 reveal">
          <span class="eyebrow">CEO Message</span>
          <h2>Leadership with a geospatial vision.</h2>
          <div class="quote-box">
            <p>
              With over 15 years in geospatial technology, I've led
              transformative projects across the region including
              Bangladesh's first navigation system and Pakistan's first
              Cadastral Mapping of State Lands Project.
            </p>
            <p class="mb-0">
              That journey led me to found GMET in 2025 to turn geospatial
              intelligence into practical, measurable impact.
            </p>
          </div>
          <a
            class="text-link d-inline-block mt-4"
            href="{{ url('/about#ceo') }}"
            >Read the full CEO message →</a
          >
        </div>
      </div>
    </div>
  </section>

  <section class="section section-green">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow light">Vision &amp; Mission</span>
        <h2>
          Innovating Today • Engineering Tomorrow • Mapping the Future
        </h2>
      </div>
      <div class="row g-4">
        <div class="col-lg-6 reveal">
          <div class="dark-panel">
            <span>Our Vision / Philosophy</span>
            <p>
              To become the trusted global partner for geospatial
              innovation, delivering intelligent engineering solutions that
              inspire progress, drive sustainability, and shape the future.
            </p>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <div class="dark-panel">
            <span>Our Mission</span>
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

  <section class="section section-tint">
    <div class="container">
      <div class="section-heading reveal">
        <span class="eyebrow">Featured Projects</span>
        <h2>Turning expertise into practical solutions.</h2>
        <p>
          GMET's profile records projects involving mineral identification,
          stereo satellite acquisition, and digital surveying.
        </p>
      </div>
      <div class="row g-4">
        @forelse($featuredProjects as $fProj)
        <div class="col-md-6 col-xl-4 reveal">
          <div class="project-card">
            <span>0{{ $loop->iteration }}</span>
            <h3>{{ $fProj->title }}</h3>
            <small>{{ $fProj->client }}</small>
            <p>{{ $fProj->key_terms ?: Str::limit($fProj->details, 90) }}</p>
          </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">Projects will be updated soon.</div>
        @endforelse
      </div>
      <div class="text-center mt-5">
        <a class="btn btn-gmet" href="{{ url('/projects') }}"
          >View Project Details</a
        >
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-heading text-center reveal">
        <span class="eyebrow">Meet Our Team</span>
        <h2>People behind the geospatial work.</h2>
      </div>
      <div class="row g-4">
        @forelse($team as $m)
        <div class="col-md-6 col-xl-4 reveal">
          <article class="team-card">
            <div class="team-img-wrap">
              @if($m->image && file_exists(public_path('assets/images/' . $m->image)))
                <img
                  src="{{ asset('assets/images/' . $m->image) }}"
                  alt="{{ $m->fullname }}"
                />
              @elseif($m->image && file_exists(public_path('uploads/team/' . $m->image)))
                <img
                  src="{{ asset('uploads/team/' . $m->image) }}"
                  alt="{{ $m->fullname }}"
                />
              @else
                <img
                  src="{{ asset('assets/images/gmet-logo.jpeg') }}"
                  alt="{{ $m->fullname }}"
                />
              @endif
            </div>
            <div class="team-meta">
              <span>{{ $m->designation }}</span>
              <h3>{{ $m->fullname }}</h3>
              <p>{{ Str::limit($m->intro, 190) }}</p>
            </div>
          </article>
        </div>
        @empty
        <div class="col-12 text-center text-muted">No team members listed yet.</div>
        @endforelse
      </div>
      <div class="text-center mt-5">
        <a class="btn btn-outline-gmet-dark" href="{{ url('/team') }}"
          >Meet the Full Team</a
        >
      </div>
    </div>
  </section>

  <section class="section contact-strip">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-8 reveal">
          <span class="eyebrow light">Get In Touch</span>
          <h2>
            Let's create new opportunities through geospatial intelligence.
          </h2>
          <p>
            Office #103 &amp; 104, 1st Floor, Rawal Mall &amp; Residencia,
            Rawalpindi.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end reveal">
          <a href="{{ url('/contact') }}" class="btn btn-gmet">Contact GMET</a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
