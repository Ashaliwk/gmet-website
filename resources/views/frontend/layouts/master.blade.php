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
        class="navbar-brand d-flex align-items-center gap-2"
        href="{{ url('/') }}">

        <img
          src="{{ asset('assets/images/gmet-logo.png') }}"
          alt="GMET Logo"
          style="
            width: 65px !important;
            height: 65px !important;
            max-width: none !important;
            max-height: none !important;
            object-fit: contain !important;
            border-radius: 15px;
        ">
        <span class="fs-2">
          GME <b>TECHNOLOGIES</b>
          <h6 class="mb-0">Geo Mapping Engineering & Technologies</h6>
        </span>

      </a><button
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
      <div class="row g-5">
        <div class="col-lg-4 footer-company">
          <div class="footer-brand">
            <img
              src="{{ asset('assets/images/gmet-logo.png') }}"
              class="footer-logo"
              alt="GMET logo" />
            <div class="footer-brand-text">
              <h4 class="mb-3">GME TECHNOLOGIES</h4>
            </div>
          </div>
          <p class="footer-description">
            Geo Mapping Engineering & Technologies — transforming
            geospatial intelligence into impact.
          </p>
          <div class="footer-contact">
            <a href="mailto:info@gmetechnologies.com">
              <span class="contact-icon">
                <i class="fa-regular fa-envelope"></i>
              </span>
              <span>info@gmetechnologies.com</span>
            </a>
            <a href="tel:+923145485076">
              <span class="contact-icon">
                <i class="fa-solid fa-phone"></i>
              </span>
              <span>+92 3145485076</span>
            </a>
            <a href="tel:+92516126643">
              <span class="contact-icon">
                <i class="fa-solid fa-phone"></i>
              </span>
              <span>+92 51-6126643</span>
            </a>
            <div class="footer-address">
              <span class="contact-icon">
                <i class="fa-solid fa-location-dot"></i>
              </span>
              <span>
                Office #103 & 104, 1st Floor, Rawal Mall &
                Residencia, Rawalpindi
              </span>
            </div>
          </div>
          <div class="footer-socials">
            <a href="https://www.linkedin.com/feed/" aria-label="LinkedIn">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="https://www.facebook.com/profile.php?id=61593893199538"
              aria-label="Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-sm-4 col-lg-2 footer-column">
          <h6>
            <span class="footer-line"></span>
            Services
          </h6>
          <div class="ms-4">
            <a href="{{ url('/services') }}">
             Web GIS
            </a>
             <a href="{{ url('/services') }}">
             GeoAI
            </a>
             <a href="{{ url('/services') }}">
             LULC
            </a>
             <a href="{{ url('/services') }}">
             Landslide Mapping
            </a>
             <a href="{{ url('/services') }}">
             Town Planning
            </a>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2 footer-column me-5">
          <h6>
            <span class="footer-line"></span>
            Applications
          </h6>
          <div class="ms-4">
            <div class="ms-4">
            <a href="{{ url('/partners') }}">
             Government and Civil
            </a>
            <a href="{{ url('/partners') }}">
              Agriculture
            </a>
            <a href="{{ url('/partners') }}">
              Construction
            </a>
            <a href="{{ url('/partners') }}">
              Enviromental
            </a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2 footer-column">
          <h6>
            <span class="footer-line"></span>
            Company
          </h6>
          <div class="ms-4">
            <a href="{{ url('/about') }}">
              About Us
            </a>
            <a href="{{ url('/team') }}">
              Our Team
            </a>
            <a href="{{ url('/projects') }}">
              Projects
            </a>
            <a href="{{ url('/partner') }}">
              Partners
            </a>
            <a href="{{ url('/contact') }}">
              Contact
            </a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>
          © 2026 GME Technologies. All rights reserved.
        </span>
        <span>
          Turning Data, Technology & Ideas into Impact
        </span>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>