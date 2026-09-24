@extends('backend.layouts.main')
@section('title', 'Reviews')
@section('main-container')
            <div class="container-fluid"><br>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><a class="text-success" href="{{url('/admin')}}">Main Menu</a> | Reviews List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Booking</th>
                                    <th>Room</th>
                                    <th>Country</th>
                                    <th>Rating</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th width="160px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$review->id}}</td>
                                    <td>{{$review->name}}</td>
                                    <td>{{ $review->booking_id ? '#' . $review->booking_id : 'Manual' }}</td>
                                    <td>{{ $review->room->name ?? 'N/A' }}</td>
                                    <td>{{$review->country}}</td>
                                    <td>{{ $review->rating ? $review->rating . '/5' : 'N/A' }}</td>
                                    <td>{{$review->description}}</td>
                                    <td>
                                        <img src="/backend/images/product/{{$review->image}}" class="rounded-circle" width="50px" height="50px" alt="Image Not Found">
                                    </td>
                                    <td>
                                        @if($review->status == 1)
                                            <span class="badge badge-success p-2">Published</span>
                                        @else
                                            <span class="badge badge-secondary p-2">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" class="d-inline" action="/admin/review-approve/{{ $review->id }}">
                                            @csrf
                                            @method('patch')
                                            <button class="btn {{ $review->status == 1 ? 'btn-secondary' : 'btn-warning' }} btn-circle btn-sm" title="{{ $review->status == 1 ? 'Hide Review' : 'Publish Review' }}"><i class="fas {{ $review->status == 1 ? 'fa-eye-slash' : 'fa-check' }}"></i></button>
                                        </form>
                                        <a href="/admin/review-edit/{{ $review->id }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="post" class="d-inline" action="/admin/review-delete/{{ $review->id }}">
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
