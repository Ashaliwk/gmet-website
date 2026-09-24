<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Home') | GMET</title>
  <meta
    name="description"
    content="Geo Mapping Engineering & Technologies (GMET) — geospatial, engineering, GIS, remote sensing, surveying, UAV, Web GIS and GeoAI solutions." />
  <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/gmet-logo.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@500;600;700;800;900&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  @stack('styles')
</head>

<body>
  <nav class="navbar navbar-expand-xl fixed-top site-nav">
    <div class="container-fluid ms-5">
      <a
        class="navbar-brand d-flex align-items-center gap-2 mt-2"
        href="{{ url('/') }}"><img
                        src="{{ asset('assets/images/gmet-logo.png') }}"
                        alt="GMET Logo"
                        style="
        width: 98px !important;
        height: 98px !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: contain !important;
        border-radius: 20px;
    "><span class="fs-3">GME <b>TECHNOLOGIES</b><h6>Geo Mapping Engineering & Technologies</h6></span></a><button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-xl-center">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('services*') ? 'active' : '' }}" href="{{ url('/services') }}">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('team*') ? 'active' : '' }}" href="{{ url('/team') }}">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('projects*') ? 'active' : '' }}" href="{{ url('/projects') }}">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('partners*') ? 'active' : '' }}" href="{{ url('/partners') }}">Partners</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('resources*') ? 'active' : '' }}" href="{{ url('/resources') }}">Resources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
          </li>
          <li class="nav-item ms-xl-2">
            <button
              id="themeToggle"
              class="btn theme-toggle"
              type="button"
              aria-label="Toggle theme">
              ☾
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="site-footer">
    <div class="container py-5">
      <div class="row g-4">
        <div class="col-lg-5">
          <img
            src="{{ asset('assets/images/gmet-logo.png') }}"
            class="footer-logo"
            alt="GMET logo" />
          <h4>GME TECHNOLOGIES</h4>
          <p>
            Geo Mapping Engineering & Technologies — transforming geospatial
            intelligence into impact.
          </p>
        </div>
        <div class="col-sm-6 col-lg-3">
          <h6>Explore</h6>
          <a href="{{ url('/about') }}">About Us</a><a href="{{ url('/services') }}">Services</a><a href="{{ url('/team') }}">Our Team</a><a href="{{ url('/projects') }}">Projects</a><a href="{{ url('/partners') }}">Partners & Clients</a>
        </div>
        <div class="col-sm-6 col-lg-4">
          <h6>Get In Touch</h6>
          <p>
            Office #103 & 104, 1st Floor, Rawal Mall & Residencia, Rawalpindi
          </p>
          <a href="mailto:info@gmetechnologies.com">info@gmetechnologies.com</a><a href="tel:+923145485076">+92 3145485076</a><a href="tel:+92516126643">+92 51-6126643</a>
          <div class="mt-2">
            <a href="https://www.linkedin.com/feed/"> <i class="fa-brands fa-linkedin fs-3"></i> </a>
            <a href="https://www.facebook.com/profile.php?id=61593893199538"> <i class="ms-2 fa-brands fa-facebook fs-3"></i> </a>
          </div>
        </div>
      </div>
      <hr />
      <div class="small d-flex flex-wrap justify-content-between gap-2">
        <span>© 2026 GME Technologies. All rights reserved.</span><span>Turning Data, Technology & Ideas into Impact</span>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>