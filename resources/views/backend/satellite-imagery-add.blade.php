@extends('backend.layouts.main')
@section('title', 'Add Satellite Imagery Project')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{ url('/admin/satellite-imagery') }}">Satellite Imagery</a> &gt; Add New Project
            </h6>
            <a href="{{ url('/admin/satellite-imagery') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ url('/admin/satellite-imagery-add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Project Title -->
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Project Title / Scope <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required 
                               placeholder="e.g. High-Resolution Stereo Satellite Imagery & 3D Terrain Model">
                        <small class="text-muted">Descriptive headline for this satellite imagery showcase project.</small>
                    </div>

                    <!-- Category -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <select class="form-control" name="category">
                            <option value="Optical Imagery" {{ old('category') == 'Optical Imagery' ? 'selected' : '' }}>Optical Imagery</option>
                            <option value="Stereo & 3D DEM" {{ old('category') == 'Stereo & 3D DEM' ? 'selected' : '' }}>Stereo &amp; 3D DEM</option>
                            <option value="Multispectral & LULC" {{ old('category') == 'Multispectral & LULC' ? 'selected' : '' }}>Multispectral &amp; LULC</option>
                            <option value="SAR & Radar" {{ old('category') == 'SAR & Radar' ? 'selected' : '' }}>SAR &amp; Radar</option>
                            <option value="Change Detection" {{ old('category') == 'Change Detection' ? 'selected' : '' }}>Change Detection</option>
                            <option value="Infrastructure Monitoring" {{ old('category') == 'Infrastructure Monitoring' ? 'selected' : '' }}>Infrastructure Monitoring</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Resolution -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Spatial Resolution</label>
                        <input type="text" class="form-control" name="resolution" value="{{ old('resolution') }}" 
                               placeholder="e.g. 0.3m (30 cm) / 0.5m / 10m">
                        <small class="text-muted">Ground sample distance (GSD).</small>
                    </div>

                    <!-- Sensor / Satellite Constellation -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Satellite Sensor / Constellation</label>
                        <input type="text" class="form-control" name="sensor" value="{{ old('sensor') }}" 
                               placeholder="e.g. WorldView-3, SuperView-1, Sentinel-2">
                    </div>

                    <!-- Client or Study Region -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Client / Study Region</label>
                        <input type="text" class="form-control" name="client" value="{{ old('client') }}" 
                               placeholder="e.g. Northern Mining Corridor, Balochistan">
                    </div>
                </div>

                <div class="row">
                    <!-- Project Date -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Project Date / Year</label>
                        <input type="text" class="form-control" name="project_date" value="{{ old('project_date') }}" 
                               placeholder="e.g. 2026 or Jan 2026">
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}" placeholder="0">
                        <small class="text-muted">Lower numbers appear first (0, 1, 2...).</small>
                    </div>

                    <!-- Status Switch -->
                    <div class="col-md-4 mb-3 d-flex align-items-center pt-md-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold text-success" for="statusSwitch">
                                Active / Visible on Website
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="font-weight-bold">Project Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="6" required 
                              placeholder="Provide comprehensive details about the imagery acquisition, processing methodology (orthorectification, pansharpening, DEM generation, atmospheric correction), key analytics, and deliverables...">{{ old('description') }}</textarea>
                    <small class="text-muted">This description will be displayed on the Satellite Imagery showcase cards and the expanded details modal.</small>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="font-weight-bold">Satellite Imagery / Project Visual</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imageryImageInput" name="image" 
                               accept="image/*" onchange="previewImageryImage(this)">
                        <label class="custom-file-label" for="imageryImageInput">Choose imagery file (JPG, PNG, WebP)...</label>
                    </div>
                    <small class="text-muted d-block mt-1">Recommended: High-resolution satellite snapshot, false-color composite, DEM render, or ortho-mosaic (up to 8MB).</small>
                    
                    <div id="imagePreviewContainer" class="mt-3 p-3 bg-light border rounded text-center" style="display: none;">
                        <p class="font-weight-bold text-secondary mb-2 small text-left">Selected Image Preview:</p>
                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 280px; object-fit: contain;">
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Save Satellite Imagery Project
                    </button>
                    <a href="{{ url('/admin/satellite-imagery') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImageryImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewContainer').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
            const label = input.nextElementSibling;
            if (label) label.textContent = input.files[0].name;
        }
    }
</script>
@endpush
@endsection
