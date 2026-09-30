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
          value for clients and partners. Click on any project to view full details and images.
        </p>
      </div>

      <div class="table-responsive project-table-wrapper reveal">
        <table class="table align-middle project-table">
          <thead>
            <tr>
              <th style="width: 50px;">#</th>
              <th style="width: 80px;" class="text-center">Image</th>
              <th>Project Title</th>
              <th>Client</th>
              <th>Date / Timeline</th>
              <th style="width: 100px;" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($projects as $project)
            <tr class="project-row" 
                role="button"
                tabindex="0"
                data-title="{{ $project->title }}"
                data-timeline="{{ $project->timeline ?: '' }}"
                data-client="{{ $project->client ?: '' }}"
                data-details="{{ htmlentities($project->details ?: $project->title) }}"
                data-image="{{ $project->image_url ?: '' }}"
                title="Click to view details">
              <td><span class="project-index">{{ $loop->iteration }}</span></td>
              <td class="text-center">
                @if($project->image_url)
                  <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-table-thumb rounded shadow-sm">
                @else
                  <div class="project-table-no-thumb rounded">
                    <i class="fas fa-image text-muted"></i>
                  </div>
                @endif
              </td>
              <td>
                <div class="project-title-cell">
                  <div class="fw-bold text-dark project-name">{{ $project->title }}</div>
                </div>
              </td>
              <td>
                <span class="text-secondary small fw-semibold">{{ $project->client ?: '—' }}</span>
              </td>
              <td>
                <span class="project-timeline-badge">{{ $project->timeline ?: '—' }}</span>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-success project-view-pill" aria-label="View project details">
                  <i class="fas fa-eye me-1"></i> View
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="fas fa-folder-open fa-2x mb-2 text-muted d-block"></i>
                No projects recorded yet.
              </td>
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
      <div class="section-heading reveal text-center mb-4">
        <span class="eyebrow">Highlights</span>
        <h2>Featured Major Initiatives</h2>
      </div>
      <div class="row g-4">
        @foreach($featuredProjects as $fIndex => $featured)
        <div class="col-md-4">
          <div class="stat-card project-card-clickable h-100" 
               role="button"
               tabindex="0"
               data-title="{{ $featured->title }}"
               data-timeline="{{ $featured->timeline ?: '' }}"
               data-client="{{ $featured->client ?: '' }}"
               data-details="{{ htmlentities($featured->details ?: $featured->title) }}"
               data-image="{{ $featured->image_url ?: '' }}"
               title="Click to view details">
            @if($featured->image_url)
              <div class="featured-card-img-wrap mb-3">
                <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="img-fluid rounded featured-card-img">
              </div>
            @endif
            <span>0{{ $loop->iteration }}</span>
            <h3 class="fs-5 mt-2">{{ $featured->title }}</h3>
            @if($featured->client)
              <p class="small text-muted mb-1"><i class="fas fa-building me-1 text-success"></i>{{ $featured->client }}</p>
            @endif
            <p>{{ $featured->timeline ?: 'GMET Initiative' }}</p>
            <div class="mt-3 text-success fw-bold small d-inline-flex align-items-center">
              View Project Details <i class="fas fa-arrow-right ms-1"></i>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- Project Details Modal -->
  <div class="modal fade" id="projectDetailModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content project-modal-content shadow-lg border-0">
        <div class="modal-header border-0 pb-0 pt-4 px-4">
          <div class="w-100 me-2">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
              <span class="badge bg-light text-secondary border px-2 py-1" id="projectModalTimeline" style="display: none;">
                <i class="far fa-clock me-1"></i><span id="projectModalTimelineText"></span>
              </span>
              <span class="badge bg-light text-success border border-success-subtle px-2 py-1" id="projectModalClient" style="display: none;">
                <i class="fas fa-building me-1"></i><span id="projectModalClientText"></span>
              </span>
            </div>
            <h4 class="modal-title fw-bold text-dark mb-1" id="projectModalLabel">Project Title</h4>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body px-4 py-3">
          <!-- Project Banner / Image -->
          <div id="projectModalImageWrapper" class="project-modal-img-box mb-3" style="display: none;">
            <a id="projectModalImageLink" href="#" target="_blank" rel="noopener noreferrer" class="d-block position-relative project-img-link" title="Click to view full resolution image">
              <img id="projectModalImage" src="" alt="Project Image" class="img-fluid rounded shadow-sm w-100 project-modal-image">
              <span class="project-img-zoom-badge">
                <i class="fas fa-expand-arrows-alt me-1"></i> Full Image
              </span>
            </a>
          </div>

          <!-- Project Description Content -->
          <div class="project-modal-section">
            <h6 class="fw-bold text-dark mb-2"><i class="fas fa-align-left text-success me-2"></i>Project Overview & Details</h6>
            <div id="projectModalDescription" class="project-description-body text-secondary lh-lg">
              <!-- Description Content injected here -->
            </div>
          </div>
        </div>

        <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex justify-content-between align-items-center">
          <small class="text-muted"><i class="fas fa-shield-alt text-success me-1"></i>Geo Mapping Engineering & Technologies</small>
          <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('projectDetailModal');
    if (!modalElement) return;

    const modal = new bootstrap.Modal(modalElement);

    // Helper to decode HTML entities
    function decodeHtml(html) {
        if (!html) return '';
        const txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    }

    function openProjectModal(element) {
        const title = element.getAttribute('data-title') || 'Project Details';
        const timeline = element.getAttribute('data-timeline') || '';
        const client = element.getAttribute('data-client') || '';
        const rawDetails = element.getAttribute('data-details') || '';
        const image = element.getAttribute('data-image') || '';

        // Title
        const titleEl = document.getElementById('projectModalLabel');
        if (titleEl) titleEl.textContent = title;

        // Timeline
        const timelineWrap = document.getElementById('projectModalTimeline');
        const timelineText = document.getElementById('projectModalTimelineText');
        if (timelineWrap && timelineText) {
            if (timeline && timeline.trim() !== '' && timeline !== '—') {
                timelineText.textContent = timeline;
                timelineWrap.style.display = 'inline-flex';
            } else {
                timelineWrap.style.display = 'none';
            }
        }

        // Client
        const clientWrap = document.getElementById('projectModalClient');
        const clientText = document.getElementById('projectModalClientText');
        if (clientWrap && clientText) {
            if (client && client.trim() !== '') {
                clientText.textContent = client;
                clientWrap.style.display = 'inline-flex';
            } else {
                clientWrap.style.display = 'none';
            }
        }

        // Image
        const imgWrap = document.getElementById('projectModalImageWrapper');
        const imgEl = document.getElementById('projectModalImage');
        const imgLink = document.getElementById('projectModalImageLink');

        if (imgWrap && imgEl) {
            if (image && image.trim() !== '') {
                imgEl.onerror = function() {
                    imgWrap.style.display = 'none';
                };
                imgEl.onload = function() {
                    imgWrap.style.display = 'block';
                };
                imgEl.src = image;
                if (imgLink) {
                    imgLink.href = image;
                }
                imgWrap.style.display = 'block';
            } else {
                imgEl.src = '';
                if (imgLink) {
                    imgLink.href = '#';
                }
                imgWrap.style.display = 'none';
            }
        }

        // Description Content
        const detailsEl = document.getElementById('projectModalDescription');
        if (detailsEl) {
            const decodedDetails = decodeHtml(rawDetails);
            if (decodedDetails) {
                if (/<[a-z][\s\S]*>/i.test(decodedDetails)) {
                    detailsEl.innerHTML = decodedDetails;
                } else {
                    const paragraphs = decodedDetails.split(/\r?\n\r?\n/).map(p => {
                        const cleanP = p.trim();
                        return cleanP ? `<p class="mb-2">${cleanP.replace(/\r?\n/g, '<br>')}</p>` : '';
                    }).join('');
                    detailsEl.innerHTML = paragraphs || `<p class="mb-0">${decodedDetails}</p>`;
                }
            } else {
                detailsEl.innerHTML = '<p class="text-muted mb-0">No description recorded for this project.</p>';
            }
        }

        modal.show();
    }

    // Attach click listeners to all project rows
    document.querySelectorAll('.project-row').forEach(row => {
        row.addEventListener('click', function (e) {
            openProjectModal(this);
        });

        // Keyboard accessibility
        row.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openProjectModal(this);
            }
        });
    });

    // Attach click listeners to clickable featured cards
    document.querySelectorAll('.project-card-clickable').forEach(card => {
        card.addEventListener('click', function (e) {
            openProjectModal(this);
        });

        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openProjectModal(this);
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.project-table-wrapper {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e7efe6;
    box-shadow: 0 4px 20px rgba(18, 59, 29, 0.05);
    overflow: hidden;
}

.project-table {
    margin-bottom: 0;
}

.project-table thead th {
    background: #f7faf6;
    color: #123b1d;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 16px 20px;
    border-bottom: 2px solid #dfe9de;
}

.project-row {
    cursor: pointer;
    transition: all 0.22s ease-in-out;
}

.project-row td {
    padding: 16px 18px;
    border-bottom: 1px solid #eef3ed;
    vertical-align: middle;
}

.project-row:hover {
    background-color: #f2f8f2 !important;
    transform: scale(1.002);
}

.project-row:hover .project-name {
    color: #1f5d2b !important;
}

.project-row:hover .project-view-pill {
    background-color: #1f5d2b;
    color: #fff;
    border-color: #1f5d2b;
}

.project-index {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #eef5ea;
    color: #1f5d2b;
    font-weight: 700;
    font-size: 0.85rem;
}

.project-table-thumb {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2ece0;
    transition: transform 0.2s ease;
}

.project-row:hover .project-table-thumb {
    transform: scale(1.08);
}

.project-table-no-thumb {
    width: 48px;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f4f7f4;
    border: 1px dashed #d1ded0;
    font-size: 1.1rem;
    margin: 0 auto;
}

.project-timeline-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    background: #f4f6f4;
    color: #495057;
    font-size: 0.85rem;
    font-weight: 500;
}

.project-view-pill {
    border-radius: 20px;
    padding: 4px 14px;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

/* Highlight / Stat Cards clickable styling */
.project-card-clickable {
    cursor: pointer;
    transition: all 0.25s ease;
}

.project-card-clickable:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(31, 93, 43, 0.15);
    border-color: #1f5d2b;
}

.featured-card-img-wrap {
    height: 180px;
    overflow: hidden;
    border-radius: 10px;
}

.featured-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card-clickable:hover .featured-card-img {
    transform: scale(1.05);
}

/* Modal styling */
.project-modal-content {
    border-radius: 18px;
    overflow: hidden;
}

.project-modal-img-box {
    background: #000;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.project-img-link {
    display: block;
    overflow: hidden;
}

.project-modal-image {
    max-height: 420px;
    width: 100%;
    object-fit: contain;
    background-color: #0b140d;
    transition: opacity 0.2s ease;
}

.project-img-zoom-badge {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(18, 59, 29, 0.85);
    color: #fff;
    font-size: 0.75rem;
    padding: 4px 10px;
    border-radius: 20px;
    backdrop-filter: blur(4px);
    transition: background 0.2s ease;
}

.project-img-link:hover .project-img-zoom-badge {
    background: rgba(31, 93, 43, 0.95);
}

.project-description-body {
    font-size: 0.95rem;
    color: #3e4d41;
}

.project-description-body p {
    margin-bottom: 0.75rem;
}

.project-description-body p:last-child {
    margin-bottom: 0;
}

.text-success {
    color: #1f5d2b !important;
}

@media (max-width: 767.98px) {
    .project-table thead {
        display: none;
    }
    .project-table,
    .project-table tbody,
    .project-table tr,
    .project-table td {
        display: block;
        width: 100%;
    }
    .project-row {
        margin-bottom: 12px;
        border-bottom: 2px solid #e2ece0;
        padding: 14px 16px;
    }
    .project-row td {
        padding: 6px 0;
        border: none;
    }
    .project-row:hover {
        transform: none;
    }
    .project-modal-image {
        max-height: 250px;
    }
}
</style>
@endpush
@endsection
