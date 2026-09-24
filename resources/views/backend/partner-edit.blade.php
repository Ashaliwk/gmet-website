@extends('backend.layouts.main')
@section('title', 'Edit Partner')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Edit Partner: {{ $partner->name }}</h6>
            <a href="{{ url('/admin/partners') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Partners
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/partner-edit/'.$partner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="font-weight-bold">Partner / Organization Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $partner->name) }}" required>
                        @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" required>
                            <option value="partner" {{ old('type', $partner->type) == 'partner' ? 'selected' : '' }}>Business Partner</option>
                            <option value="client" {{ old('type', $partner->type) == 'client' ? 'selected' : '' }}>Valued Client</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Description / Overview</label>
                    <textarea class="form-control" name="description" rows="4">{{ old('description', $partner->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Website URL</label>
                        <input type="url" class="form-control" name="website" value="{{ old('website', $partner->website) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $partner->order) }}">
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ $partner->status ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">Update Partner</button>
                    <a href="{{ url('/admin/partners') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
