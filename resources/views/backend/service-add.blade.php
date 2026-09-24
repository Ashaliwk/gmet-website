@extends('backend.layouts.main')
@section('title', 'Add Service')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Add New GMET Service</h6>
            <a href="{{ url('/admin/services') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Services
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/service-add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Service Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required placeholder="e.g. GIS & Geospatial Solutions">
                        @error('title')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="e.g. GIS, Remote Sensing, Surveying">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="4" required placeholder="Service description and scope...">{{ old('description') }}</textarea>
                    @error('description')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Service Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Website</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">Save Service</button>
                    <a href="{{ url('/admin/services') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
