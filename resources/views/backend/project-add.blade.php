@extends('backend.layouts.main')
@section('title', 'Add Project')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Add New GMET Project</h6>
            <a href="{{ url('/admin/projects') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Projects
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/project-add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Client Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="client" value="{{ old('client') }}" required placeholder="e.g. Nubia Mining (Private) Limited">
                        @error('client')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Project Title / Scope <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required placeholder="e.g. Satellite Imagery Stereo Acquisition">
                        @error('title')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Document Reference</label>
                        <input type="text" class="form-control" name="document" value="{{ old('document') }}" placeholder="e.g. PO GM-LOC-PO-743, Certificate">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Date / Timeline</label>
                        <input type="text" class="form-control" name="timeline" value="{{ old('timeline') }}" placeholder="e.g. 16-01-2026; 60–75 days after PO issuance">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Key Terms & Deliverables</label>
                    <textarea class="form-control" name="key_terms" rows="3" placeholder="e.g. 30% advance payment; orthorectification; DEM/DSM/DTM at 5m...">{{ old('key_terms') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Project Details / Scope Description</label>
                    <textarea class="form-control" name="details" rows="4" placeholder="Detailed project summary...">{{ old('details') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="e.g. Satellite Solutions, Mineral Exploration">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Technology / Tools Used</label>
                        <input type="text" class="form-control" name="technology" value="{{ old('technology') }}" placeholder="e.g. GIS, RS, Drone, Web GIS">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Project Image / Document</label>
                        <input type="file" class="form-control-file border p-1" name="image">
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-checkbox mr-4">
                            <input type="checkbox" class="custom-control-input" id="featuredCheck" name="is_featured" value="1">
                            <label class="custom-control-label font-weight-bold text-warning" for="featuredCheck">Show in Highlight Cards (01, 02, 03)</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Website</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">Save Project</button>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
