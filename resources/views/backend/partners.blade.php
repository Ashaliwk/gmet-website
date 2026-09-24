@extends('backend.layouts.main')
@section('title', 'Partners & Clients')
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
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Partners & Clients ({{ count($partners) }})
            </h6>
            <a href="{{url('/admin/partner-add')}}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add Partner / Client
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">#</th>
                            <th>Partner / Organization Name</th>
                            <th width="90px">Type</th>
                            <th>Description</th>
                            <th>Website</th>
                            <th width="60px">Order</th>
                            <th width="80px">Status</th>
                            <th width="120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold text-dark">{{ $partner->name }}</td>
                            <td>
                                @if($partner->type == 'client')
                                    <span class="badge badge-info">Client</span>
                                @else
                                    <span class="badge badge-primary">Partner</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($partner->description, 120) }}</td>
                            <td>
                                @if($partner->website)
                                    <a href="{{ $partner->website }}" target="_blank" class="small"><i class="fas fa-external-link-alt mr-1"></i> Link</a>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $partner->order }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ url('/admin/partner-status/'.$partner->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($partner->status == 1)
                                        <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ url('/admin/partner-edit/'.$partner->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/partner-delete/'.$partner->id) }}" onsubmit="return confirm('Are you sure you want to delete this partner?');">
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
