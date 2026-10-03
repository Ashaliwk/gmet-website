@extends('frontend.layouts.master')
@section('title', 'Satellite Imagery & Earth Observation')

@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Earth Observation &amp; Remote Sensing</span>
    <h1>Satellite Imagery &amp; Spaceborne Solutions</h1>
    <p>
      Discover GMET's satellite imagery acquisitions, stereo 3D elevation models, multispectral earth observation, and multi-temporal remote sensing projects.
    </p>
  </div>
</header>

<main class="satellite-page-wrapper">
  <!-- Key Capabilities / Specs Ribbon -->
  <section class="py-4 bg-light border-bottom">
    <div class="container">
      <div class="row g-3 text-center align-items-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge bg-success p-2 rounded-circle"><i class="fas fa-satellite fa-sm text-white"></i></span>
            <div class="text-start">
              <span class="d-block fw-bold text-dark fs-6">Up to 0.3m Res</span>
              <small class="text-muted">Ultra-High Optical</small>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge bg-success p-2 rounded-circle"><i class="fas fa-layer-group fa-sm text-white"></i></span>
            <div class="text-start">
              <span class="d-block fw-bold text-dark fs-6">Stereo 3D DEM</span>
              <small class="text-muted">High-Precision Elevation</small>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge bg-success p-2 rounded-circle"><i class="fas fa-wave-square fa-sm text-white"></i></span>
            <div class="text-start">
              <span class="d-block fw-bold text-dark fs-6">Multispectral &amp; SAR</span>
              <small class="text-muted">Day / Night &amp; Radar</small>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge bg-success p-2 rounded-circle"><i class="fas fa-globe-asia fa-sm text-white"></i></span>
            <div class="text-start">
              <span class="d-block fw-bold text-dark fs-6">Global Constellations</span>
              <small class="text-muted">Tasking &amp; Archival Data</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Projects Showcase Section -->
  <section class="section py-5">
    <div class="container">
      <div class="section-heading reveal text-center mb-4">
        <span class="eyebrow">Projects Showcase</span>
        <h2>High-Precision Satellite Imagery Portfolio</h2>
        <p class="mx-auto" style="max-width: 760px;">
          Explore our operational satellite acquisitions, stereoscopic 3D terrain modeling, multispectral analysis, and environmental monitoring projects delivered for clients and partners.
        </p>
      </div>

      <!-- Filter Tabs -->
      <div class="d-flex flex-wrap justify-content-center gap-2 mb-5 reveal">
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn active" data-filter="all">
          <i class="fas fa-globe me-1"></i> All Projects ({{ count($imageryProjects) }})
        </button>
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn" data-filter="Optical Imagery">
          <i class="fas fa-camera me-1"></i> Optical Imagery
        </button>
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn" data-filter="Stereo & 3D DEM">
          <i class="fas fa-mountain me-1"></i> Stereo &amp; 3D DEM
        </button>
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn" data-filter="Multispectral & LULC">
          <i class="fas fa-leaf me-1"></i> Multispectral &amp; LULC
        </button>
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn" data-filter="SAR & Radar">
          <i class="fas fa-broadcast-tower me-1"></i> SAR &amp; Radar
        </button>
        <button class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill sat-filter-btn" data-filter="Change Detection">
          <i class="fas fa-history me-1"></i> Change Detection
        </button>
      </div>

      <!-- Projects Grid -->
      <div class="row g-4" id="satelliteProjectsGrid">
        @forelse($imageryProjects as $item)
        <div class="col-lg-4 col-md-6 sat-project-card-col reveal" data-category="{{ $item->category ?: 'Optical Imagery' }}">
          <div class="sat-project-card h-100 d-flex flex-column rounded-4 overflow-hidden border shadow-sm"
               role="button"
               tabindex="0"
               onclick="openSatelliteModal(this)"
               data-title="{{ $item->title }}"
               data-category="{{ $item->category ?: 'Optical Imagery' }}"
               data-resolution="{{ $item->resolution ?: '' }}"
               data-sensor="{{ $item->sensor ?: '' }}"
               data-client="{{ $item->client ?: '' }}"
               data-date="{{ $item->project_date ?: '' }}"
               data-description="{{ htmlentities($item->description) }}"
               data-image="{{ $item->image_url ?: '' }}">

            <!-- Image Area -->
            <div class="sat-card-img-wrapper position-relative overflow-hidden">
              @if($item->image_url)
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="sat-card-img w-100" loading="lazy">
              @else
                <div class="sat-card-placeholder d-flex flex-column align-items-center justify-content-center text-muted">
                  <i class="fas fa-satellite fa-3x mb-2 text-success opacity-75"></i>
                  <span class="small fw-semibold">Satellite Imagery</span>
                </div>
              @endif

              <!-- Floating Badges -->
              <div class="sat-floating-badges position-absolute top-0 start-0 w-100 p-3 d-flex justify-content-between align-items-start pointer-events-none">
                @if($item->category)
                  <span class="badge sat-badge-category">
                    {{ $item->category }}
                  </span>
                @else
                  <span></span>
                @endif

                @if($item->resolution)
                  <span class="badge sat-badge-res">
                    <i class="fas fa-expand-arrows-alt me-1"></i>{{ $item->resolution }}
                  </span>
                @endif
              </div>

              <!-- Sensor Pill at bottom of image -->
              @if($item->sensor)
              <div class="sat-sensor-pill position-absolute bottom-0 start-0 m-3 px-2 py-1 rounded small fw-semibold text-white">
                <i class="fas fa-satellite me-1"></i>{{ $item->sensor }}
              </div>
              @endif

              <div class="sat-card-overlay d-flex align-items-center justify-content-center">
                <span class="btn btn-sm btn-light fw-bold shadow-sm">
                  <i class="fas fa-expand me-1 text-success"></i> View Details
                </span>
              </div>
            </div>

            <!-- Content Area -->
            <div class="sat-card-body p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex align-items-center justify-content-between text-muted small mb-2">
                @if($item->client)
                  <span class="fw-semibold text-secondary">
                    <i class="fas fa-map-marker-alt text-success me-1"></i>{{ $item->client }}
                  </span>
                @else
                  <span></span>
                @endif

                @if($item->project_date)
                  <span class="badge bg-light text-dark border">
                    <i class="far fa-calendar-alt text-muted me-1"></i>{{ $item->project_date }}
                  </span>
                @endif
              </div>

              <h3 class="sat-card-title fs-5 fw-bold text-dark mb-2">
                {{ $item->title }}
              </h3>

              <p class="sat-card-desc text-muted flex-grow-1 mb-3">
                {{ Str::limit(strip_tags($item->description), 130) }}
              </p>

              <!-- Footer action button -->
              <div class="sat-card-footer pt-3 mt-auto border-top d-flex align-items-center justify-content-between">
                <span class="text-success fw-bold small">
                  Explore Project <i class="fas fa-arrow-right ms-1"></i>
                </span>
                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" aria-label="Open project details">
                  <i class="fas fa-eye me-1"></i> Details
                </button>
              </div>
            </div>
          </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12 text-center py-5">
          <div class="empty-state-box p-5 rounded-4 border bg-light mx-auto" style="max-width: 650px;">
            <div class="sat-empty-icon mb-3">
              <i class="fas fa-satellite fa-4x text-success opacity-75"></i>
            </div>
            <h4 class="fw-bold text-dark">Satellite Imagery Portfolio Updating</h4>
            <p class="text-muted mb-4">
              Our team is currently uploading the latest high-resolution satellite imagery datasets and remote sensing showcases. Please check back shortly or contact our geospatial engineers for custom tasking.
            </p>
            <a href="{{ url('/contact') }}" class="btn btn-success px-4 py-2 rounded-pill font-weight-bold">
              <i class="fas fa-paper-plane me-1"></i> Request Satellite Imagery
            </a>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Capabilities & Workflow Section -->
  <section class="section section-tint py-5 border-top">
    <div class="container">
      <div class="section-heading reveal text-center mb-5">
        <span class="eyebrow">Technical Pipeline</span>
        <h2>End-to-End Satellite Processing &amp; Analytics</h2>
        <p class="mx-auto" style="max-width: 760px;">
          From high-resolution sensor tasking to orthorectification, photogrammetric elevation generation, and GeoAI feature extraction.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4 bg-white text-center sat-feature-card">
            <div class="sat-feature-icon mx-auto mb-3">
              <i class="fas fa-satellite text-success fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Constellation Tasking</h5>
            <p class="text-muted small mb-0">
              Access to world-leading optical and radar satellite constellations with flexible tasking angles and archival collections.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 reveal">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4 bg-white text-center sat-feature-card">
            <div class="sat-feature-icon mx-auto mb-3">
              <i class="fas fa-ruler-combined text-success fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Orthorectification</h5>
            <p class="text-muted small mb-0">
              Precision geometric correction, sensor model calibration, pansharpening, and tie-point alignment with sub-meter ground control.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 reveal">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4 bg-white text-center sat-feature-card">
            <div class="sat-feature-icon mx-auto mb-3">
              <i class="fas fa-mountain text-success fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Stereo 3D DEMs</h5>
            <p class="text-muted small mb-0">
              High-accuracy Digital Surface Models (DSM) and Digital Terrain Models (DTM) extracted from in-track and cross-track stereo pairs.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 reveal">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4 bg-white text-center sat-feature-card">
            <div class="sat-feature-icon mx-auto mb-3">
              <i class="fas fa-brain text-success fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">GeoAI &amp; Change Analysis</h5>
            <p class="text-muted small mb-0">
              Deep learning object detection, Land Use / Land Cover (LULC) classification, vegetation indices (NDVI/EVI), and temporal change tracking.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner Section -->
  <section class="py-5 text-white sat-cta-banner">
    <div class="container text-center py-3">
      <span class="eyebrow light mb-2 d-inline-block">Custom Acquisition</span>
      <h2 class="text-white fw-bold mb-3">Need Satellite Imagery or Custom Analytics for Your Area?</h2>
      <p class="text-white-50 mx-auto mb-4" style="max-width: 680px; font-size: 1.1rem;">
        Contact GMET's remote sensing and spaceborne systems specialists to discuss your AOI (Area of Interest), resolution requirements, stereo tasking, or archival data needs.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ url('/contact') }}" class="btn btn-light px-4 py-2 fw-bold rounded-pill text-dark shadow">
          <i class="fas fa-envelope me-2 text-success"></i> Contact Geospatial Team
        </a>
        <a href="{{ url('/services') }}" class="btn btn-outline-light px-4 py-2 fw-bold rounded-pill">
          <i class="fas fa-cogs me-2"></i> Explore All GMET Services
        </a>
      </div>
    </div>
  </section>
</main>

<!-- Interactive Satellite Project Modal -->
<div class="modal fade" id="satelliteDetailModal" tabindex="-1" aria-labelledby="satelliteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <!-- Modal Header -->
      <div class="modal-header bg-dark text-white border-0 py-3 px-4">
        <div>
          <span class="badge bg-success mb-1" id="modalSatCategory">Optical Imagery</span>
          <h5 class="modal-title fw-bold text-white mb-0" id="satelliteModalLabel">Satellite Imagery Project</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <!-- Image Preview Area -->
        <div id="modalSatImageWrapper" class="position-relative mb-4 rounded-3 overflow-hidden border bg-black text-center" style="display: none;">
          <img id="modalSatImage" src="#" alt="Satellite Project" class="img-fluid rounded" style="max-height: 440px; width: 100%; object-fit: contain;">
          <a id="modalSatImageLink" href="#" target="_blank" class="btn btn-sm btn-dark position-absolute bottom-0 end-0 m-3 opacity-90 shadow">
            <i class="fas fa-external-link-alt me-1"></i> Open Full High-Res
          </a>
        </div>

        <!-- Key Technical Specs Badges -->
        <div class="row g-2 mb-4 p-3 bg-light rounded-3 border">
          <div class="col-6 col-sm-3" id="modalResolutionWrap">
            <small class="text-muted d-block"><i class="fas fa-expand-arrows-alt me-1 text-success"></i> Resolution</small>
            <span class="fw-bold text-dark small" id="modalSatResolution">—</span>
          </div>
          <div class="col-6 col-sm-3" id="modalSensorWrap">
            <small class="text-muted d-block"><i class="fas fa-satellite me-1 text-success"></i> Sensor / Platform</small>
            <span class="fw-bold text-dark small" id="modalSatSensor">—</span>
          </div>
          <div class="col-6 col-sm-3" id="modalClientWrap">
            <small class="text-muted d-block"><i class="fas fa-map-marker-alt me-1 text-success"></i> Study Area / Client</small>
            <span class="fw-bold text-dark small" id="modalSatClient">—</span>
          </div>
          <div class="col-6 col-sm-3" id="modalDateWrap">
            <small class="text-muted d-block"><i class="far fa-calendar-alt me-1 text-success"></i> Project Date</small>
            <span class="fw-bold text-dark small" id="modalSatDate">—</span>
          </div>
        </div>

        <!-- Description -->
        <div>
          <h6 class="fw-bold text-dark mb-2">Project Overview &amp; Technical Scope</h6>
          <div class="text-secondary sat-modal-description" id="modalSatDescription" style="line-height: 1.7; white-space: pre-line;">
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer bg-light border-top px-4 py-3 d-flex justify-content-between">
        <a href="{{ url('/contact') }}" class="btn btn-success rounded-pill px-4 fw-bold">
          <i class="fas fa-paper-plane me-2"></i> Inquire About This Solution
        </a>
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
  /* Satellite Page Theming */
  .sat-project-card {
    background: #fff;
    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    cursor: pointer;
  }
  .sat-project-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(18, 59, 29, 0.12) !important;
    border-color: rgba(31, 93, 43, 0.35) !important;
  }
  .sat-card-img-wrapper {
    height: 220px;
    background: #0f1d13;
  }
  .sat-card-img {
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .sat-project-card:hover .sat-card-img {
    transform: scale(1.05);
  }
  .sat-card-placeholder {
    height: 100%;
    background: linear-gradient(135deg, #123b1d, #1f5d2b);
    color: #fff;
  }
  .sat-badge-category {
    background: rgba(12, 38, 19, 0.88);
    backdrop-filter: blur(6px);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
  .sat-badge-res {
    background: rgba(31, 93, 43, 0.9);
    backdrop-filter: blur(6px);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 6px 10px;
    border-radius: 20px;
  }
  .sat-sensor-pill {
    background: rgba(0, 0, 0, 0.72);
    backdrop-filter: blur(4px);
    font-size: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }
  .sat-card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(12, 38, 19, 0.4);
    opacity: 0;
    transition: opacity 0.25s ease;
  }
  .sat-project-card:hover .sat-card-overlay {
    opacity: 1;
  }
  .sat-card-title {
    color: var(--gmet-dark);
    line-height: 1.35;
  }
  .sat-filter-btn {
    font-weight: 600;
    border-color: #c9dac3;
    color: #2e4a33;
    transition: all 0.2s ease;
  }
  .sat-filter-btn:hover,
  .sat-filter-btn.active {
    background: var(--gmet-green) !important;
    border-color: var(--gmet-green) !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(31, 93, 43, 0.25);
  }
  .sat-feature-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .sat-feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.08) !important;
  }
  .sat-feature-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--gmet-light);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .sat-cta-banner {
    background: linear-gradient(135deg, #0c2613 0%, #174b22 55%, #1f5d2b 100%);
    position: relative;
    overflow: hidden;
  }
  .sat-cta-banner::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 80% 30%, rgba(255, 255, 255, 0.12), transparent 45%);
    pointer-events: none;
  }
</style>
@endpush

@push('scripts')
<script>
  // Filter Tabs
  document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.sat-filter-btn');
    const projectCards = document.querySelectorAll('.sat-project-card-col');

    filterButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        filterButtons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');

        projectCards.forEach(card => {
          if (filter === 'all' || card.getAttribute('data-category') === filter) {
            card.style.display = 'block';
            card.style.animation = 'fadeInUp 0.35s ease forwards';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  });

  // Modal Handler
  function openSatelliteModal(element) {
    const title = element.getAttribute('data-title') || 'Satellite Imagery Project';
    const category = element.getAttribute('data-category') || 'Optical Imagery';
    const resolution = element.getAttribute('data-resolution') || '';
    const sensor = element.getAttribute('data-sensor') || '';
    const client = element.getAttribute('data-client') || '';
    const date = element.getAttribute('data-date') || '';
    const description = element.getAttribute('data-description') || '';
    const image = element.getAttribute('data-image') || '';

    // Set Text Content
    document.getElementById('satelliteModalLabel').textContent = title;
    document.getElementById('modalSatCategory').textContent = category;
    document.getElementById('modalSatDescription').innerHTML = description;

    // Resolution
    const resWrap = document.getElementById('modalResolutionWrap');
    const resEl = document.getElementById('modalSatResolution');
    if (resolution && resolution.trim() !== '') {
      resEl.textContent = resolution;
      resWrap.style.display = 'block';
    } else {
      resEl.textContent = 'Standard Optical';
      resWrap.style.display = 'block';
    }

    // Sensor
    const sensorWrap = document.getElementById('modalSensorWrap');
    const sensorEl = document.getElementById('modalSatSensor');
    if (sensor && sensor.trim() !== '') {
      sensorEl.textContent = sensor;
      sensorWrap.style.display = 'block';
    } else {
      sensorEl.textContent = 'Multi-constellation';
      sensorWrap.style.display = 'block';
    }

    // Client / Study Area
    const clientWrap = document.getElementById('modalClientWrap');
    const clientEl = document.getElementById('modalSatClient');
    if (client && client.trim() !== '') {
      clientEl.textContent = client;
      clientWrap.style.display = 'block';
    } else {
      clientEl.textContent = 'Confidential / GMET AOI';
      clientWrap.style.display = 'block';
    }

    // Date
    const dateWrap = document.getElementById('modalDateWrap');
    const dateEl = document.getElementById('modalSatDate');
    if (date && date.trim() !== '') {
      dateEl.textContent = date;
      dateWrap.style.display = 'block';
    } else {
      dateEl.textContent = 'Active Project';
      dateWrap.style.display = 'block';
    }

    // Image
    const imgWrap = document.getElementById('modalSatImageWrapper');
    const imgEl = document.getElementById('modalSatImage');
    const imgLink = document.getElementById('modalSatImageLink');

    if (image && image.trim() !== '') {
      imgEl.src = image;
      imgLink.href = image;
      imgWrap.style.display = 'block';
    } else {
      imgEl.src = '';
      imgWrap.style.display = 'none';
    }

    // Trigger Bootstrap Modal
    const modalEl = document.getElementById('satelliteDetailModal');
    if (modalEl && typeof bootstrap !== 'undefined') {
      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    }
  }
</script>
@endpush
@endsection
