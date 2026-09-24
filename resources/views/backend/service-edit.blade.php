@extends('backend.layouts.main')
@section('title', 'Edit Service')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Edit GMET Service: {{ $service->title }}</h6>
            <a href="{{ url('/admin/services') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Services
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/service-edit/'.$service->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Service Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $service->title) }}" required>
                        @error('title')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Category</label>
                        <input type="text" class="form-control" name="category" value="{{ old('category', $service->category) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="4" required>{{ old('description', $service->description) }}</textarea>
                    @error('description')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Icon Symbol</label>
                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $service->icon) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $service->order) }}">
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ $service->status ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Website</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">Update Service</button>
                    <a href="{{ url('/admin/services') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
