@extends('backend.layouts.main')
@section('title', 'Edit Team Member')
@section('main-container')
<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Edit Team Member: {{ $team->fullname }}</h6>
            <a href="{{ url('/admin/team') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Team List
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/team-edit/'.$team->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="fullname" value="{{ old('fullname', $team->fullname) }}" required>
                        @error('fullname')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Designation / Role <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="designation" value="{{ old('designation', $team->designation) }}" required>
                        @error('designation')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email', $team->email) }}">
                        @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">LinkedIn URL</label>
                        <input class="form-control" type="text" name="linkedin" value="{{ old('linkedin', $team->linkedin) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Biography / Introduction <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="intro" rows="5" required>{{ old('intro', $team->intro) }}</textarea>
                    @error('intro')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Profile Photo</label>
                        <div class="mb-2">
                            @if($team->image)
                                @if(file_exists(public_path('assets/images/'.$team->image)))
                                    <img src="{{ asset('assets/images/'.$team->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 50%;" class="border border-success">
                                @elseif(file_exists(public_path('uploads/team/'.$team->image)))
                                    <img src="{{ asset('uploads/team/'.$team->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 50%;" class="border border-success">
                                @endif
                            @endif
                        </div>
                        <input class="form-control-file border p-1" type="file" name="image" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Display Order</label>
                        <input class="form-control" type="number" name="order" value="{{ old('order', $team->order) }}">
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-center pt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ $team->status ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="statusSwitch">Active / Visible on Team Page</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 font-weight-bold">Update Team Member</button>
                    <a href="{{ url('/admin/team') }}" class="btn btn-light ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
