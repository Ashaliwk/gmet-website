@extends('backend.layouts.main')
@section('title', 'Add room Item')
@section('main-container')
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block p-4 border-left-success">
                    <strong>
                        {{$message}}
                    </strong>
                </div>
            @endif
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{url('/admin/room')}}"><button class="btn btn-success">room Item List</button></a></a>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/admin/room-edit/{{$rooms->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-floating mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="{{old('name', $rooms->name)}}"/>
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{$errors->first('name')}}
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <label for="price">Price</label>
                                <input class="form-control" id="price" type="text" placeholder="Enter Price" name="price" value="{{old('price', $rooms->price)}}"/>
                                @if ($errors->has('price'))
                                    <span class="text-danger">
                                        {{$errors->first('price')}}
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <label for="description">Description</label>
                                <input class="form-control" id="description" type="text" placeholder="Enter Description" name="description" value="{{old('description', $rooms->description)}}"/>
                                @if ($errors->has('description'))
                                    <span class="text-danger">
                                        {{$errors->first('description')}}
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="room_type" class="form-label">Room Type</label>
                                    <select class="form-select form-control" id="room_type" name="room_type">
                                        <option value="economy" {{ old('room_type', $rooms->room_type) == 'economy' ? 'selected' : '' }}>Economy</option>
                                        <option value="luxury" {{ old('room_type', $rooms->room_type) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                        <option value="suite" {{ old('room_type', $rooms->room_type) == 'suite' ? 'selected' : '' }}>Suite</option>
                                        <option value="family" {{ old('room_type', $rooms->room_type) == 'family' ? 'selected' : '' }}>Family</option>
                                        <option value="single" {{ old('room_type', $rooms->room_type) == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="double" {{ old('room_type', $rooms->room_type) == 'double' ? 'selected' : '' }}>Double</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="max_persons" class="form-label">Max Persons</label>
                                    <input class="form-control" id="max_persons" type="number" name="max_persons" value="{{ old('max_persons', $rooms->max_persons) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ac_type" class="form-label">AC Type</label>
                                    <select class="form-select form-control" id="ac_type" name="ac_type">
                                        <option value="AC" {{ old('ac_type', $rooms->ac_type) == 'AC' ? 'selected' : '' }}>AC</option>
                                        <option value="Non-AC" {{ old('ac_type', $rooms->ac_type) == 'Non-AC' ? 'selected' : '' }}>Non-AC</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bed_type" class="form-label">Bed Type</label>
                                    <select class="form-select form-control" id="bed_type" name="bed_type">
                                        <option value="Single Bed" {{ old('bed_type', $rooms->bed_type) == 'Single Bed' ? 'selected' : '' }}>Single Bed</option>
                                        <option value="Double Bed" {{ old('bed_type', $rooms->bed_type) == 'Double Bed' ? 'selected' : '' }}>Double Bed</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="meal_plan" class="form-label">Meal Plan</label>
                                    <select class="form-select form-control" id="meal_plan" name="meal_plan">
                                        <option value="No Meal" {{ old('meal_plan', $rooms->meal_plan) == 'No Meal' ? 'selected' : '' }}>No Meal</option>
                                        <option value="Breakfast" {{ old('meal_plan', $rooms->meal_plan) == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                                        <option value="Lunch" {{ old('meal_plan', $rooms->meal_plan) == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                                        <option value="Dinner" {{ old('meal_plan', $rooms->meal_plan) == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                                        <option value="Full Board" {{ old('meal_plan', $rooms->meal_plan) == 'Full Board' ? 'selected' : '' }}>Full Board</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="room_status" class="form-label">Room Status</label>
                                    <select class="form-select form-control" id="room_status" name="room_status">
                                        <option value="available" {{ old('room_status', $rooms->room_status) == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="booked" {{ old('room_status', $rooms->room_status) == 'booked' ? 'selected' : '' }}>Booked</option>
                                        <option value="maintenance" {{ old('room_status', $rooms->room_status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 d-flex align-items-center">
                                    <div class="form-check mr-4">
                                        <input class="form-check-input" type="checkbox" id="is_wifi" name="is_wifi" {{ old('is_wifi', $rooms->is_wifi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_wifi">Free WiFi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_parking" name="is_parking" {{ old('is_parking', $rooms->is_parking) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_parking">Free Parking</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <label for="image">Image</label>
                                <input class="form-control" id="image" type="file" name="image" value="{{old('image', $rooms->image)}}" style="padding-bottom:38px">
                                @if ($errors->has('image'))
                                    <span class="text-danger">
                                        {{$errors->first('image')}}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <input class="btn btn-success btn-block" type="submit" value="Submit" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
