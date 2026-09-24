@extends('backend.layouts.main')
@section('title', 'Dashboard')
@section('main-container')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">GMET Overview Dashboard</h1>
        <a href="{{ url('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-external-link-alt fa-sm text-white-50 mr-1"></i> Visit Website
        </a>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Services Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Services & Solutions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalServices ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Projects
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalProjects ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Team Members
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalTeam ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partners Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Partners & Clients
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalPartners ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Inquiries Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Contact Inquiries
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalContacts ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope-open-text fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admins Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Admin Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $TotalAdmins ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Row -->
    <div class="row">
        <!-- Recent Inquiries -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Contact Inquiries</h6>
                    <a href="{{ url('/admin/contacts') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentInquiries) && count($recentInquiries) > 0)
                    <div class="list-group">
                        @foreach($recentInquiries as $inq)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 font-weight-bold">{{ $inq->name }} <small class="text-muted">({{ $inq->email }})</small></h6>
                                <small class="text-muted">{{ $inq->created_at ? $inq->created_at->diffForHumans() : '' }}</small>
                            </div>
                            <p class="mb-1 font-weight-bold text-dark">{{ $inq->subject }}</p>
                            <p class="mb-1 text-muted small">{{ Str::limit($inq->message, 90) }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted mb-0">No contact inquiries yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-success">Active GMET Projects</h6>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentProjects) && count($recentProjects) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProjects as $p)
                                <tr>
                                    <td class="font-weight-bold">{{ $p->client }}</td>
                                    <td>{{ Str::limit($p->title, 40) }}</td>
                                    <td>
                                        @if($p->status)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-secondary">Disabled</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted mb-0">No projects added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection