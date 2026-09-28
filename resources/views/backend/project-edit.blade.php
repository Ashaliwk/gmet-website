@extends('backend.layouts.main')
@section('title', 'Edit Project')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Edit Project: {{ $project->title }}</h6>
            <a href="{{ url('/admin/projects') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Projects
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/project-edit/'.$project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Client Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="client" value="{{ old('client', $project->client) }}" required>
                        @error('client')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Project Title / Scope <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Date / Timeline</label>
                        <input type="text" class="form-control" name="timeline" value="{{ old('timeline', $project->timeline) }}" placeholder="e.g. 16-01-2026; 60–75 days">
                        @error('timeline')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $project->order) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Project Description / Details</label>
                    <textarea class="form-control" name="details" rows="5" placeholder="Detailed description of the project, deliverables, and outcomes...">{{ old('details', $project->details) }}</textarea>
                    <small class="text-muted">This full description will be shown in the project detail popup on the website.</small>
                    @error('details')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Project Image</label>
                        
                        @if($project->image_url)
                            <div class="mb-2 p-2 bg-light rounded border d-flex align-items-center gap-3">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 90px; max-width: 140px; object-fit: cover;">
                                <div>
                                    <span class="badge badge-success mb-1">Current Image Active</span>
                                    <br><small class="text-muted text-break">{{ str_starts_with($project->image, 'data:') ? 'Uploaded Image File' : $project->image }}</small>
                                </div>
                            </div>
                        @endif

                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="projectImageEditInput" name="image" accept="image/*" onchange="previewProjectImage(this)">
                            <label class="custom-file-label" for="projectImageEditInput">{{ $project->image ? 'Choose new image to replace...' : 'Choose image file...' }}</label>
                        </div>
                        <small class="text-muted">Leave empty to keep current image. Accepts JPG, PNG, WebP (max 5MB).</small>
                        @error('image')<span class="text-danger small d-block">{{ $message }}</span>@enderror
                        
                        <div id="imagePreviewWrapper" class="mt-2" style="display: none;">
                            <span class="badge badge-info mb-1">New Image Preview</span><br>
                            <img id="imagePreview" src="#" alt="New Preview" class="img-thumbnail" style="max-height: 180px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-center pt-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="featuredCheck" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold text-warning" for="featuredCheck">Show in Highlight Cards (01, 02, 03)</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-center pt-md-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ old('status', $project->status) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Website</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-2 border-top">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">
                        <i class="fas fa-check-circle mr-1"></i> Update Project
                    </button>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewProjectImage(input) {
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
