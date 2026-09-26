@extends('backend.layouts.main')
@section('title', 'Services & Solutions')
@section('main-container')
<div class="container-fluid"><br>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Services & Solutions ({{ count($services) }})
            </h6>
            <a href="{{url('/admin/service-add')}}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Service
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">#</th>
                            <th width="50px">Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th width="110px">Category</th>
                            <th width="60px">Order</th>
                            <th width="80px">Status</th>
                            <th width="130px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $srv)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center font-weight-bold text-success" style="font-size: 18px;">@if($srv->image)
                                <img src="{{ $srv->image }}"
                                    alt="{{ $srv->title }}"
                                    style="max-height:40px; max-width:60px; object-fit:contain;">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="font-weight-bold">{{ $srv->title }}</td>
                            <td>{{ Str::limit($srv->description, 100) }}</td>
                            <td><span class="badge badge-info">{{ $srv->category ?: 'General' }}</span></td>
                            <td class="text-center">{{ $srv->order }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ url('/admin/service-status/'.$srv->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($srv->status == 1)
                                    <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ url('/admin/service-edit/'.$srv->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/service-delete/'.$srv->id) }}" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
@endsection