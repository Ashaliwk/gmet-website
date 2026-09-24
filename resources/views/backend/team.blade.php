@extends('backend.layouts.main')
@section('title', 'Team Members')
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
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Team Members ({{ count($teams) }})
            </h6>
            <a href="{{url('/admin/team-add')}}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-user-plus fa-sm text-white-50 mr-1"></i> Add Team Member
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">#</th>
                            <th width="65px">Photo</th>
                            <th>Full Name</th>
                            <th>Designation</th>
                            <th>Introduction</th>
                            <th width="60px">Order</th>
                            <th width="80px">Status</th>
                            <th width="130px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($team->image)
                                    @if(file_exists(public_path('assets/images/'.$team->image)))
                                        <img src="{{ asset('assets/images/'.$team->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;" class="border border-success">
                                    @elseif(file_exists(public_path('uploads/team/'.$team->image)))
                                        <img src="{{ asset('uploads/team/'.$team->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;" class="border border-success">
                                    @else
                                        <img src="{{ asset('backend/images/profile.svg') }}" width="50" height="50" class="rounded-circle">
                                    @endif
                                @else
                                    <img src="{{ asset('backend/images/profile.svg') }}" width="50" height="50" class="rounded-circle">
                                @endif
                            </td>
                            <td class="font-weight-bold">{{ $team->fullname }}</td>
                            <td><span class="badge badge-primary">{{ $team->designation }}</span></td>
                            <td>{{ Str::limit($team->intro, 110) }}</td>
                            <td class="text-center">{{ $team->order }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ url('/admin/team-status/'.$team->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($team->status == 1)
                                        <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ url('/admin/team-edit/'.$team->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/team-delete/'.$team->id) }}" onsubmit="return confirm('Are you sure you want to delete this team member?');">
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