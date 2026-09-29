@extends('frontend.layouts.master')
@section('title', 'Register for ' . $application->title)

@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Application Access Registration</span>
    <h1>{{ $application->title }}</h1>
    <p>
      Please complete the registration form below to obtain authorized access to this GMET completed application.
    </p>
  </div>
</header>

<main class="py-5 registration-page-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="mb-4">
          <a href="{{ url('/applications') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
          </a>
        </div>

        @if(session('success'))
        <!-- Access Granted Box fallback -->
        <div class="card access-granted-card shadow-lg border-0 rounded-4 mb-4 p-4 p-md-5 text-center">
          <div class="mb-3">
            <i class="fas fa-circle-check text-success fa-4x"></i>
          </div>
          <h2 class="fw-bold text-dark mb-2">Registration Successful!</h2>
          <p class="text-secondary fs-5 mb-4">
            {{ session('success') }}
          </p>

          <div class="p-3 bg-light rounded-3 border mb-4 text-start mx-auto" style="max-width: 600px;">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-success font-weight-bold px-3 py-1">{{ $application->display_number }}</span>
              <span class="badge bg-secondary font-weight-bold px-3 py-1">{{ $application->category ?: 'Web GIS' }}</span>
            </div>
            <h5 class="fw-bold text-dark mb-1">{{ $application->title }}</h5>
            <p class="small text-muted mb-0">{{ Str::limit(strip_tags($application->description), 180) }}</p>
          </div>

          <div class="d-flex flex-wrap justify-content-center gap-3">
            @if($application->app_link && $application->app_link !== '#')
              <a href="{{ $application->app_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-gmet-launch btn-lg rounded-pill px-5 shadow">
                <i class="fas fa-external-link-alt me-2"></i> Launch Application Now
              </a>
            @else
              <div class="alert alert-info small text-center mb-0">
                <i class="fas fa-info-circle me-1"></i> The direct external link for this application is being attached by the administrator. Your registration has been saved.
              </div>
            @endif
          </div>
        </div>
        @else

        <div class="row g-4 align-items-stretch">
          <!-- Left: Application Details Card -->
          <div class="col-lg-5">
            <div class="card app-info-card h-100 shadow-sm border-0 rounded-4 p-4">
              <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge bg-success font-weight-bold px-3 py-1 rounded-pill">
                  <i class="fas fa-hashtag me-1"></i>{{ $application->display_number }}
                </span>
                @if($application->category)
                <span class="badge bg-light text-success border px-3 py-1 rounded-pill">
                  {{ $application->category }}
                </span>
                @endif
              </div>

              <h3 class="fw-bold text-dark mb-3">{{ $application->title }}</h3>

              @if($application->image_url)
              <div class="mb-3 rounded-3 overflow-hidden shadow-sm">
                <img src="{{ $application->image_url }}" alt="{{ $application->title }}" class="img-fluid w-100" style="max-height: 200px; object-fit: cover;">
              </div>
              @endif

              <div class="app-desc-content text-secondary small lh-lg mb-4 flex-grow-1">
                <h6 class="fw-bold text-success mb-2"><i class="fas fa-info-circle me-1"></i> About This Solution</h6>
                {{ $application->description }}
              </div>

              @if($application->technology)
              <div class="border-top pt-3 mt-auto">
                <small class="text-muted d-block font-weight-bold mb-1">Technology Stack:</small>
                <span class="badge bg-light text-dark border px-2 py-1">{{ $application->technology }}</span>
              </div>
              @endif
            </div>
          </div>

          <!-- Right: Registration Form Card -->
          <div class="col-lg-7">
            <div class="card registration-form-card shadow-sm border-0 rounded-4 p-4 p-md-5 position-relative">
              <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1">
                  <i class="fas fa-user-plus text-success me-2"></i> Register for Access
                </h3>
                <p class="text-muted small mb-0">
                  Please fill out the form below. Once registered with a valid email, you will immediately be directed to this application.
                </p>
              </div>

              <div id="formAlertBox" class="alert alert-danger d-none" role="alert"></div>

              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 small">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <form id="dedicatedRegisterForm" method="POST" action="{{ url('/applications/' . $application->id . '/register') }}">
                @csrf

                <div class="row g-3">
                  <!-- Full Name -->
                  <div class="col-12">
                    <label for="name" class="form-label fw-bold small">Full Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                    </div>
                  </div>

                  <!-- Valid Email -->
                  <div class="col-12">
                    <label for="email" class="form-label fw-bold small">Valid Email Address <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                    </div>
                    <small class="text-muted">A valid email address is required for access.</small>
                  </div>

                  <!-- Phone Number -->
                  <div class="col-md-6">
                    <label for="phone" class="form-label fw-bold small">Phone / Mobile Number</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                      <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+92 300 1234567">
                    </div>
                  </div>

                  <!-- Organization -->
                  <div class="col-md-6">
                    <label for="organization" class="form-label fw-bold small">Organization / Institute</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                      <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}" placeholder="e.g. University / Department / Company">
                    </div>
                  </div>

                  <!-- Purpose of Access -->
                  <div class="col-12">
                    <label for="purpose" class="form-label fw-bold small">Purpose of Access / Requirements</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-comment-dots"></i></span>
                      <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Briefly explain your requirement or project interest...">{{ old('purpose') }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="mt-4 pt-2">
                  <button type="submit" id="submitBtn" class="btn btn-gmet-action w-100 py-3 rounded-pill shadow">
                    <span class="btn-text"><i class="fas fa-check-circle me-2"></i> Register & Access Application</span>
                    <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</main>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
  .registration-page-wrapper {
    min-height: 70vh;
    background: #fdfdfd;
  }
  .app-info-card {
    background: #ffffff;
    border: 1px solid #dfe8dc !important;
  }
  .registration-form-card {
    background: #ffffff;
    border: 1px solid #dfe8dc !important;
  }
  .access-granted-card {
    background: #ffffff;
    border: 1px solid #cce5c8 !important;
  }
  .btn-gmet-launch {
    background: linear-gradient(135deg, #1f5d2b, #123b1d);
    color: #ffffff !important;
    font-weight: 700;
  }
  .btn-gmet-launch:hover {
    background: #123b1d;
    transform: translateY(-2px);
  }

  /* Custom SweetAlert GMET styling */
  .gmet-swal-popup {
    border-radius: 1.25rem !important;
    font-family: Inter, sans-serif !important;
    padding: 2rem !important;
  }
  .gmet-swal-title {
    font-family: Montserrat, sans-serif !important;
    font-weight: 800 !important;
    color: #123b1d !important;
    font-size: 1.5rem !important;
  }
  .gmet-swal-confirm-btn {
    background: #1f5d2b !important;
    border-radius: 50rem !important;
    padding: 10px 28px !important;
    font-weight: 700 !important;
    font-size: 0.95rem !important;
    box-shadow: 0 4px 14px rgba(31, 93, 43, 0.35) !important;
  }

  /* Dark Theme */
  body.dark .registration-page-wrapper {
    background: #0b140d;
  }
  body.dark .app-info-card,
  body.dark .registration-form-card,
  body.dark .access-granted-card {
    background: #122017 !important;
    border-color: #263b2a !important;
    color: #edf5ea;
  }
  body.dark .app-info-card h3,
  body.dark .registration-form-card h3,
  body.dark .access-granted-card h2,
  body.dark .access-granted-card h5 {
    color: #edf5ea !important;
  }
  body.dark .form-control,
  body.dark .input-group-text {
    background-color: #0c1710;
    border-color: #2b4530;
    color: #edf5ea;
  }
  body.dark .form-control:focus {
    background-color: #0c1710;
    border-color: #4a7552;
    color: #edf5ea;
  }
  body.dark .form-label {
    color: #d6e8d2;
  }
  body.dark .app-desc-content {
    color: #c2d6c0 !important;
  }
  body.dark .gmet-swal-popup {
    background: #122017 !important;
    color: #edf5ea !important;
    border: 1px solid #2a4730 !important;
  }
  body.dark .gmet-swal-title {
    color: #edf5ea !important;
  }
  body.dark .gmet-swal-popup .swal2-html-container {
    color: #c2d6c0 !important;
  }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('dedicatedRegisterForm');
    if (!form) return;

    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const spinner = submitBtn.querySelector('.spinner-border');
    const alertBox = document.getElementById('formAlertBox');

    // Auto-fill previously remembered user info if available
    const savedName = localStorage.getItem('gmet_user_name');
    const savedEmail = localStorage.getItem('gmet_user_email');
    const savedPhone = localStorage.getItem('gmet_user_phone');
    const savedOrg = localStorage.getItem('gmet_user_org');

    if (savedName && !document.getElementById('name').value) document.getElementById('name').value = savedName;
    if (savedEmail && !document.getElementById('email').value) document.getElementById('email').value = savedEmail;
    if (savedPhone && !document.getElementById('phone').value) document.getElementById('phone').value = savedPhone;
    if (savedOrg && !document.getElementById('organization').value) document.getElementById('organization').value = savedOrg;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const org = document.getElementById('organization').value.trim();
        const purpose = document.getElementById('purpose').value.trim();

        if (!name || !email) {
            alertBox.textContent = 'Please provide both your full name and a valid email address.';
            alertBox.classList.remove('d-none');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alertBox.textContent = 'Please provide a valid email format (e.g. name@example.com).';
            alertBox.classList.remove('d-none');
            return;
        }

        alertBox.classList.add('d-none');
        submitBtn.disabled = true;
        btnText.textContent = 'Registering Access...';
        spinner.classList.remove('d-none');

        const token = form.querySelector('input[name="_token"]').value;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
                phone: phone,
                organization: org,
                purpose: purpose
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            // Save in localStorage
            localStorage.setItem('gmet_user_name', name);
            localStorage.setItem('gmet_user_email', email);
            if (phone) localStorage.setItem('gmet_user_phone', phone);
            if (org) localStorage.setItem('gmet_user_org', org);

            const isDark = document.body.classList.contains('dark');
            const targetUrl = data.redirect_url;

            if (targetUrl) {
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Complete!',
                    html: `<p class="mb-3">Thank you, <b>${data.user_name}</b>! Your registration for <b>${data.app_title}</b> has been recorded successfully.</p><div class="p-2 bg-light rounded text-success fw-bold small mb-2"><i class="fas fa-spinner fa-spin me-1"></i> Moving you to application in <b id="swalCountdown">2</b> seconds...</div>`,
                    timer: 2200,
                    timerProgressBar: true,
                    confirmButtonText: '<i class="fas fa-external-link-alt me-1"></i> Open Application Now',
                    customClass: {
                        popup: 'gmet-swal-popup',
                        title: 'gmet-swal-title',
                        confirmButton: 'gmet-swal-confirm-btn btn'
                    },
                    didOpen: () => {
                        const b = Swal.getHtmlContainer().querySelector('#swalCountdown');
                        timerInterval = setInterval(() => {
                            if (b) {
                                const remaining = Math.ceil(Swal.getTimerLeft() / 1000);
                                b.textContent = remaining;
                            }
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    // Redirect to the application link
                    window.location.href = targetUrl;
                });
            } else {
                submitBtn.disabled = false;
                btnText.innerHTML = '<i class="fas fa-check-circle me-2"></i> Register & Access Application';
                spinner.classList.add('d-none');

                Swal.fire({
                    icon: 'success',
                    title: 'Registration Complete!',
                    text: `Thank you, ${data.user_name}! Your registration has been saved. The application link is currently being attached by the administration.`,
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'gmet-swal-popup',
                        title: 'gmet-swal-title',
                        confirmButton: 'gmet-swal-confirm-btn btn'
                    }
                });
            }
        })
        .catch(error => {
            submitBtn.disabled = false;
            btnText.innerHTML = '<i class="fas fa-check-circle me-2"></i> Register & Access Application';
            spinner.classList.add('d-none');

            let message = 'An error occurred while completing registration. Please check your info and try again.';
            if (error.errors) {
                const firstKey = Object.keys(error.errors)[0];
                message = error.errors[firstKey][0];
            } else if (error.message) {
                message = error.message;
            }

            alertBox.textContent = message;
            alertBox.classList.remove('d-none');
        });
    });
});
</script>
@endpush
@endsection
