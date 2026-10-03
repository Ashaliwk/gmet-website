@extends('frontend.layouts.master')
@section('title', 'Get In Touch')
@section('content')
<header class="page-head">
  <div class="container">
    <span class="eyebrow light">Get In Touch</span>
    <h1>Let’s create new opportunities</h1>
    <p>
      GMET is based at Rawal Mall &amp; Residencia, Rawalpindi. The contact
      details are mentioned below.
    </p>
  </div>
</header>
<main>
  <section class="section">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 reveal">
          <span class="eyebrow">Contact GMET</span>
          <h2>Connect with Geo Mapping Engineering &amp; Technologies.</h2>
          <p class="lead">
            We sincerely appreciate your time and interest in our business
            profile. Our commitment is to deliver quality, innovation, and
            value while building strong and lasting relationships with our
            customers and partners.
          </p>
          <div class="contact-details">
            <div>
              <span>Email</span
              ><a href="mailto:info@gmetechnologies.com"
                >info@gmetechnologies.com</a
              >
            </div>
            <div>
              <span>Mobile</span
              ><a href="tel:+92 344 5828712">+92 344 5828712</a>
            </div>
            <div>
              <span>Office</span
              ><a href="tel:+92516126643">+92 51-6126643</a>
            </div>
            <div>
              <span>Address</span>
              <p>
                Office #103 &amp; 104, 1st Floor, Rawal Mall &amp; Residencia,
                Rawalpindi
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <div class="contact-box">
            <h3 class="mb-5">Submit a request</h3>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('frontend.contact.submit') }}" id="contactForm">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required />
                  @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" required />
                  @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="e.g. Geospatial Services Inquiry" />
                  @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label class="form-label">Message <span class="text-danger">*</span></label>
                  <textarea
                    class="form-control"
                    name="message"
                    rows="6"
                    required
                    placeholder="Tell us about your project or inquiry..."
                  >{{ old('message') }}</textarea>
                  @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <button class="btn btn-gmet" type="submit" id="submitBtn">
                    Send Enquiry
                  </button>
                </div>
              </div>
            </form>
            <div id="formMsg" class="alert alert-success d-none mt-3 mb-0"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<div class="container mb-5"> 
  <div class="row">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3321.9034728609045!2d73.07176517630407!3d33.63374473971144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df95da88cff691%3A0xcf9bcedfe227350b!2sRawal%20Mall%20And%20Residencia!5e0!3m2!1sen!2s!4v1790940819477!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe></div>
 </div>
    </div>
@endsection
