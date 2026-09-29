@extends('backend.layouts.main')
@section('title', 'Applications')
@section('main-container')
<div class="container-fluid"><br>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Stat cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalApps }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop-code fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeApps }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-toggle-on fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Quick Actions</div>
                            <a href="{{ url('/admin/application-registrations') }}" class="btn btn-sm btn-outline-info mt-1 font-weight-bold">
                                <i class="fas fa-list mr-1"></i> View All Registrations
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Completed Applications ({{ count($applications) }})
            </h6>
            <div class="d-flex gap-2">
                <a href="{{url('/admin/application-registrations')}}" class="btn btn-sm btn-info shadow-sm mr-2">
                    <i class="fas fa-users fa-sm text-white-50 mr-1"></i> Registered Users ({{ $totalRegistrations }})
                </a>
                <a href="{{url('/admin/application-add')}}" class="btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Application
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover responsive-stack-table align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">#</th>
                            <th width="85px">App No.</th>
                            <th width="75px">Image</th>
                            <th>Application Title & Category</th>
                            <th>Description</th>
                            <th>Application Link</th>
                            <th width="105px" class="text-center">Registrations</th>
                            <th width="80px" class="text-center">Status</th>
                            <th width="120px" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $app)
                        <tr>
                            <td data-label="#">{{ $loop->iteration }}</td>
                            <td data-label="App No.">
                                <span class="badge badge-dark font-weight-bold px-2 py-1">
                                    {{ $app->display_number }}
                                </span>
                            </td>
                            <td data-label="Image" class="text-center">
                                @if($app->image_url)
                                    <img src="{{ $app->image_url }}" alt="{{ $app->title }}" class="img-thumbnail" style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light border rounded text-muted" style="width: 55px; height: 55px; font-size: 1.2rem;">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                @endif
                            </td>
                            <td data-label="Title">
                                <div class="font-weight-bold text-dark">{{ $app->title }}</div>
                                <div class="mt-1">
                                    @if($app->category)
                                        <span class="badge badge-success px-2 py-1">{{ $app->category }}</span>
                                    @endif
                                    @if($app->technology)
                                        <small class="text-muted ml-1"><i class="fas fa-code mr-1"></i>{{ $app->technology }}</small>
                                    @endif
                                </div>
                            </td>
                            <td data-label="Description">
                                <small class="text-secondary">{{ Str::limit(strip_tags($app->description), 120) }}</small>
                            </td>
                            <td data-label="Link">
                                @if($app->app_link && $app->app_link !== '#')
                                    <a href="{{ $app->app_link }}" target="_blank" class="btn btn-xs btn-outline-primary font-weight-bold" title="{{ $app->app_link }}">
                                        <i class="fas fa-external-link-alt mr-1"></i> Open Link
                                    </a>
                                    <div class="small text-muted text-truncate mt-1" style="max-width: 180px;">
                                        {{ $app->app_link }}
                                    </div>
                                @else
                                    <span class="badge badge-warning text-dark font-weight-normal px-2 py-1">
                                        <i class="fas fa-link mr-1"></i> Pending Link
                                    </span>
                                    <small class="d-block text-muted mt-1">Admin can attach link</small>
                                @endif
                            </td>
                            <td data-label="Registrations" class="text-center">
                                <a href="{{ url('/admin/application-registrations?application_id='.$app->id) }}" class="btn btn-sm btn-outline-info font-weight-bold" title="View registered users">
                                    <i class="fas fa-users mr-1"></i> {{ $app->registrations_count }}
                                </a>
                            </td>
                            <td data-label="Status" class="text-center">
                                <form method="POST" action="{{ url('/admin/application-status/'.$app->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($app->status == 1)
                                        <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td data-label="Actions" class="text-center">
                                <a href="{{ url('/admin/application-edit/'.$app->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit Application & Link">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/application-delete/'.$app->id) }}" onsubmit="return confirm('Are you sure you want to delete this application and its registration records?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-laptop-code fa-2x mb-2 d-block text-muted"></i>
                                No applications created yet. <a href="{{ url('/admin/application-add') }}" class="font-weight-bold text-success">Add your first application</a>.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media (max-width: 767.98px) {
        .responsive-stack-table thead {
            display: none;
        }
        .responsive-stack-table,
        .responsive-stack-table tbody,
        .responsive-stack-table tr,
        .responsive-stack-table td {
            display: block;
            width: 100%;
        }
        .responsive-stack-table tr {
            margin-bottom: 1rem;
            border: 1px solid #e3e6f0;
            border-radius: .35rem;
            background: #fff;
            padding: .5rem;
        }
        .responsive-stack-table td {
            text-align: right;
            position: relative;
            padding-left: 45% !important;
            border-top: none;
            border-bottom: 1px solid #f8f9fc;
        }
        .responsive-stack-table td::before {
            content: attr(data-label);
            position: absolute;
            left: .75rem;
            width: 40%;
            text-align: left;
            font-weight: 700;
            color: #4e73df;
        }
    }
</style>
@endpush
@endsection
