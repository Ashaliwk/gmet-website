@extends('backend.layouts.main')
@section('title', 'Edit Satellite Imagery Project')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{ url('/admin/satellite-imagery') }}">Satellite Imagery</a> &gt; Edit Project #{{ $project->id }}
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

            <form method="POST" action="{{ url('/admin/satellite-imagery-edit/'.$project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Project Title -->
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Project Title / Scope <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}" required 
                               placeholder="e.g. High-Resolution Stereo Satellite Imagery & 3D Terrain Model">
                    </div>

                    <!-- Category -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <select class="form-control" name="category">
                            @php $cat = old('category', $project->category); @endphp
                            <option value="Optical Imagery" {{ $cat == 'Optical Imagery' ? 'selected' : '' }}>Optical Imagery</option>
                            <option value="Stereo & 3D DEM" {{ $cat == 'Stereo & 3D DEM' ? 'selected' : '' }}>Stereo &amp; 3D DEM</option>
                            <option value="Multispectral & LULC" {{ $cat == 'Multispectral & LULC' ? 'selected' : '' }}>Multispectral &amp; LULC</option>
                            <option value="SAR & Radar" {{ $cat == 'SAR & Radar' ? 'selected' : '' }}>SAR &amp; Radar</option>
                            <option value="Change Detection" {{ $cat == 'Change Detection' ? 'selected' : '' }}>Change Detection</option>
                            <option value="Infrastructure Monitoring" {{ $cat == 'Infrastructure Monitoring' ? 'selected' : '' }}>Infrastructure Monitoring</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Resolution -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Spatial Resolution</label>
                        <input type="text" class="form-control" name="resolution" value="{{ old('resolution', $project->resolution) }}" 
                               placeholder="e.g. 0.3m (30 cm) / 0.5m / 10m">
                    </div>

                    <!-- Sensor / Satellite Constellation -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Satellite Sensor / Constellation</label>
                        <input type="text" class="form-control" name="sensor" value="{{ old('sensor', $project->sensor) }}" 
                               placeholder="e.g. WorldView-3, SuperView-1, Sentinel-2">
                    </div>

                    <!-- Client or Study Region -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Client / Study Region</label>
                        <input type="text" class="form-control" name="client" value="{{ old('client', $project->client) }}" 
                               placeholder="e.g. Northern Mining Corridor, Balochistan">
                    </div>
                </div>

                <div class="row">
                    <!-- Project Date -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Project Date / Year</label>
                        <input type="text" class="form-control" name="project_date" value="{{ old('project_date', $project->project_date) }}" 
                               placeholder="e.g. 2026 or Jan 2026">
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $project->order) }}" placeholder="0">
                    </div>

                    <!-- Status Switch -->
                    <div class="col-md-4 mb-3 d-flex align-items-center pt-md-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" 
                                   {{ old('status', $project->status) == '1' ? 'checked' : '' }}>
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
                              placeholder="Provide comprehensive details about the imagery acquisition, processing methodology, key analytics, and deliverables...">{{ old('description', $project->description) }}</textarea>
                </div>

                <!-- Image Upload & Current Image Preview -->
                <div class="mb-4">
                    <label class="font-weight-bold">Satellite Imagery / Project Visual</label>
                    
                    @if($project->image_url)
                    <div class="mb-3 p-3 bg-light border rounded d-flex align-items-center gap-3">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" 
                             class="img-thumbnail" style="max-height: 120px; max-width: 180px; object-fit: cover;">
                        <div class="ml-3">
                            <p class="mb-1 font-weight-bold text-dark">Current Image</p>
                            <a href="{{ $project->image_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye mr-1"></i> View Full Size
                            </a>
                            <small class="text-muted d-block mt-1">Upload a new file below if you wish to replace it.</small>
                        </div>
                    </div>
                    @endif

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imageryImageInput" name="image" 
                               accept="image/*" onchange="previewImageryImage(this)">
                        <label class="custom-file-label" for="imageryImageInput">
                            {{ $project->image ? 'Choose new image to replace...' : 'Choose imagery file (JPG, PNG, WebP)...' }}
                        </label>
                    </div>
                    <small class="text-muted d-block mt-1">Leave empty to keep the existing image.</small>
                    
                    <div id="imagePreviewContainer" class="mt-3 p-3 bg-light border rounded text-center" style="display: none;">
                        <p class="font-weight-bold text-success mb-2 small text-left">New Replacement Preview:</p>
                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 280px; object-fit: contain;">
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Update Satellite Imagery Project
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
