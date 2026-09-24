{{-- resources/views/backend/room-add.blade.php --}}
@extends('backend.layouts.main')
@section('title', 'Add Room Item')
@section('main-container')


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Add New Room</h5>
            <a href="{{ url('/admin/room') }}">
                <button class="btn btn-success btn-sm">Room List</button>
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('/admin/room-add') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('name') is-invalid @enderror"
                                   id="name" type="text" name="name"
                                   value="{{ old('name') }}" placeholder="Enter Room Name/Number" required>
                            <label for="name">Room Name / Number</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control @error('price') is-invalid @enderror"
                                   id="price" type="number" step="0.01" name="price"
                                   value="{{ old('price') }}" placeholder="Price" required>
                            <label for="price">Price per Night</label>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description"
                                      style="height: 120px">{{ old('description') }}</textarea>
                            <label for="description">Description</label>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select form-control" id="room_type" name="room_type">
                                    <option value="economy">Economy</option>
                                    <option value="luxury">Luxury</option>
                                    <option value="suite">Suite</option>
                                    <option value="family">Family</option>
                                    <option value="single">Single</option>
                                    <option value="double">Double</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="max_persons" class="form-label">Max Persons</label>
                                <input class="form-control" id="max_persons" type="number" name="max_persons" value="{{ old('max_persons') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ac_type" class="form-label">AC Type</label>
                                <select class="form-select form-control" id="ac_type" name="ac_type">
                                    <option value="AC">AC</option>
                                    <option value="Non-AC">Non-AC</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bed_type" class="form-label">Bed Type</label>
                                <select class="form-select form-control" id="bed_type" name="bed_type">
                                    <option value="Single Bed">Single Bed</option>
                                    <option value="Double Bed">Double Bed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meal_plan" class="form-label">Meal Plan</label>
                                <select class="form-select form-control" id="meal_plan" name="meal_plan">
                                    <option value="No Meal">No Meal</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Dinner">Dinner</option>
                                    <option value="Full Board">Full Board</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_status" class="form-label">Room Status</label>
                                <select class="form-select form-control" id="room_status" name="room_status">
                                    <option value="available">Available</option>
                                    <option value="booked">Booked</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check mr-4">
                                    <input class="form-check-input" type="checkbox" id="is_wifi" name="is_wifi" {{ old('is_wifi') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_wifi">Free WiFi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_parking" name="is_parking" {{ old('is_parking') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_parking">Free Parking</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Room Image</label>
                            <input class="form-control @error('image') is-invalid @enderror p-1"
                                   id="image" type="file" accept=".png,.jpg,.jpeg,.webp" name="image" required>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-lg px-5">
                            Add Room
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection