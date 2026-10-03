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
  <nav class="navbar navbar-expand-lg fixed-top site-nav" id="siteNavbar">
    <div class="container-fluid px-3 px-lg-4">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img
          src="{{ asset('assets/images/gmet-logo.png') }}"
          alt="GMET Logo"
          class="brand-logo">
        <span class="brand-text fs-5">
          GME <b>TECHNOLOGIES</b>
          <small>Geo Mapping Engineering &amp; Technologies</small>
        </span>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav"
        aria-controls="mainNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

          {{-- Home --}}
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('projects*') ? 'active' : '' }}" href="{{ url('/projects') }}">Projects</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (Request::is('services*') || Request::is('applications*') || Request::is('satelliteimagery*') || Request::is('satellite-imagery*')) ? 'active' : '' }}"
              href="#" id="solutionsDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Solutions
            </a>
            <ul class="dropdown-menu site-dropdown" aria-labelledby="solutionsDropdown">
              <li><a class="dropdown-item {{ Request::is('services*') ? 'active' : '' }}" href="{{ url('/services') }}">Services</a></li>
              <li><a class="dropdown-item {{ Request::is('applications*') ? 'active' : '' }}" href="{{ url('/applications') }}">Products</a></li>
              <li><a class="dropdown-item {{ (Request::is('satelliteimagery*') || Request::is('satellite-imagery*')) ? 'active' : '' }}" href="{{ url('/satelliteimagery') }}">Satellite Imagery</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}">Blog</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (Request::is('ecosystem*') || Request::is('partners*')) ? 'active' : '' }}"
              href="#" id="solutionsDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Ecosystem
            </a>
            <ul class="dropdown-menu site-dropdown" aria-labelledby="solutionsDropdown">
              <li class="nav-item">
                <a class="dropdown-item {{ Request::is('partners*') ? 'active' : '' }}" href="{{ url('/partners') }}">Partners</a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item {{ Request::is('resources*') ? 'active' : '' }}" href="{{ url('/resources') }}">Resources</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link contact-btn {{ Request::is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact Us</a>
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
            Geo Mapping Engineering &amp; Technologies — transforming
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
              <span>+92 344 5828712</span>
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
                Office #103 &amp; 104, 1st Floor, Rawal Mall &amp;
                Residencia, Rawalpindi
              </span>
            </div>
          </div>
          <div class="footer-socials">
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
            <a href="{{ url('/services') }}">Web GIS</a>
            <a href="{{ url('/satelliteimagery') }}">Satellite Imagery</a>
            <a href="{{ url('/services') }}">GeoAI</a>
            <a href="{{ url('/services') }}">LULC</a>
            <a href="{{ url('/services') }}">Landslide Mapping</a>
            <a href="{{ url('/services') }}">Town Planning</a>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2 footer-column me-5">
          <h6>
            <span class="footer-line"></span>
            Applications
          </h6>
          <div class="ms-4">
            <a href="{{ url('/applications') }}">All Applications</a>
            <a href="{{ url('/applications') }}">Government &amp; Civil</a>
            <a href="{{ url('/applications') }}">Agriculture GIS</a>
            <a href="{{ url('/applications') }}">Environmental Mapping</a>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2 footer-column">
          <h6>
            <span class="footer-line"></span>
            Quick Links
          </h6>
          <div class="ms-4">
            <a href="{{ url('/about') }}">About GMET</a>
            <a href="{{ url('/team') }}">Our Team</a>
            <a href="{{ url('/projects') }}">Projects</a>
            <a href="{{ url('/partner') }}">Partners</a>
            <a href="{{ url('/contact') }}">Contact</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 GME Technologies. All rights reserved.</span>
        <span>Turning Data, Technology &amp; Ideas into Impact</span>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @include('frontend.chatbot')
  @stack('scripts')
</body>
</html>