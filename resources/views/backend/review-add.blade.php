@extends('backend.layouts.main')
@section('title', 'Add Reviews')
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
                        <a href="{{url('/admin/reviews')}}"><button class="btn btn-success">Reviews List</button></a></a>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/admin/review-add" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="{{old('name')}}"/>
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{$errors->first('name')}}
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <label for="country">Country</label>
                                <input class="form-control" id="country" type="text" placeholder="Enter Country" name="country" value="{{old('country')}}"/>
                                @if ($errors->has('country'))
                                    <span class="text-danger">
                                        {{$errors->first('country')}}
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <label for="description">Description</label>
                                <input class="form-control" id="description" type="text" placeholder="Enter Description" name="description" value="{{old('description')}}"/>
                                @if ($errors->has('description'))
                                    <span class="text-danger">
                                        {{$errors->first('description')}}
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <label for="image">Image</label>
                                <input class="form-control" id="image" type="file" accept=".png, .jpg, .jpeg" name="image" value="{{old('image')}}" style="padding-bottom:38px">
                                @if ($errors->has('image'))
                                    <span class="text-danger">
                                        {{$errors->first('image')}}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <input class="btn btn-success btn-block" type="submit" value="Add Reviews" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
