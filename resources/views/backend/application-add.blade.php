@extends('backend.layouts.main')
@section('title', 'Add Application')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Add New GMET Application</h6>
            <a href="{{ url('/admin/applications') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Applications
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/application-add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- App Number / Code -->
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Application Number / ID</label>
                        <input type="text" class="form-control" name="app_number" value="{{ old('app_number', $suggestedNumber ?? 'APP-01') }}" placeholder="e.g. APP-01 or GMET-01">
                        <small class="text-muted">Displayed as the number badge on the card (e.g. APP-01).</small>
                        @error('app_number')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Application Title -->
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Application Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required placeholder="e.g. Web GIS Interactive Spatial Portal">
                        @error('title')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Application Link -->
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Application Link / URL</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                            </div>
                            <input type="url" class="form-control" name="app_link" value="{{ old('app_link') }}" placeholder="https://app.gmetechnologies.com or external URL">
                        </div>
                        <small class="text-muted">You can attach your application link here. Users who register will be able to launch this link directly.</small>
                        @error('app_link')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <input type="text" class="form-control" name="category" value="{{ old('category', 'Web GIS & GeoAI') }}" placeholder="e.g. Web GIS, Remote Sensing, AI">
                        @error('category')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Technology / Stack -->
                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold">Technology / Platform</label>
                        <input type="text" class="form-control" name="technology" value="{{ old('technology') }}" placeholder="e.g. GeoServer / Leaflet / React">
                        @error('technology')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="font-weight-bold">Application Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="5" required placeholder="Detailed description of what this application does, key geospatial features, data layers, capabilities, and user instructions...">{{ old('description') }}</textarea>
                    <small class="text-muted">Shown in the application card and the registration/view modal.</small>
                    @error('description')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <!-- Image Upload -->
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Application Screenshot / Thumbnail</label>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="appImageInput" name="image" accept="image/*" onchange="previewAppImage(this)">
                            <label class="custom-file-label" for="appImageInput">Choose screenshot or banner...</label>
                        </div>
                        <small class="text-muted">Upload a screenshot or preview banner (JPG, PNG, WebP, max 5MB).</small>
                        @error('image')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                        <div id="imagePreviewWrapper" class="mt-2" style="display: none;">
                            <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 180px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Order -->
                    <div class="col-md-2 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}" placeholder="0">
                        <small class="text-muted">Lower numbers appear first.</small>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4 mb-3 d-flex align-items-center pt-md-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Website</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-2 border-top">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Save Application
                    </button>
                    <a href="{{ url('/admin/applications') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewAppImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewWrapper').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
            const label = input.nextElementSibling;
            if (label) label.textContent = input.files[0].name;
        }
    }
</script>
@endpush
@endsection
