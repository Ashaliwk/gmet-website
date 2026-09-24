@extends('backend.layouts.main')
@section('title', 'room')
@section('main-container')
            <div class="container-fluid"><br>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><a class="text-success" href="{{url('/admin')}}">Main Menu</a> | Room List</h6>
                        <a href="{{url('/admin/room-add')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right"><i
                        class="fas fa-plus fa-sm text-white-50"></i>Add Room</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Persons</th>
                                    <th>AC/Bed</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th width="160px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$room->name}}</td>
                                    <td><span class="badge badge-info">{{ ucfirst($room->room_type) }}</span></td>
                                    <td>{{$room->max_persons}}</td>
                                    <td>{{$room->ac_type}} / {{$room->bed_type}}</td>
                                    <td>{{$room->price}} PKR</td>
                                    <td>
                                        <img src="/backend/images/product/{{$room->image}}" class="rounded-circle" width="50px" height="50px" alt="Image Not Found">
                                    </td>
                                    <td>
                                        @if($room->room_status == 'available')
                                            <span class="badge badge-success p-2">Available</span>
                                        @elseif($room->room_status == 'booked')
                                            <span class="badge badge-warning p-2">Booked</span>
                                        @else
                                            <span class="badge badge-secondary p-2">Maintenance</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#">
                                            <a href="/admin/room-edit/{{ $room->id }}" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </a>
                                        <form method="post" class="d-inline" action="/admin/room-delete/{{ $room->id }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-circle btn-sm" onClick="return confirm('Are you sure you want to Delete Record')"; title="Delete Record"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
