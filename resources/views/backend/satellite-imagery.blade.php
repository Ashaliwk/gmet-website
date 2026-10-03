@extends('backend.layouts.main')
@section('title', 'Satellite Imagery Projects')
@section('main-container')
<div class="container-fluid"><br>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h6 class="m-0 font-weight-bold text-success">
                    <a class="text-success" href="{{ url('/admin') }}">Dashboard</a> | Satellite Imagery Projects ({{ count($imageries) }})
                </h6>
                <small class="text-muted">Total: {{ $totalCount }} | Active: {{ $activeCount }}</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('/satelliteimagery') }}" target="_blank" class="btn btn-sm btn-outline-info mr-2 shadow-sm">
                    <i class="fas fa-external-link-alt fa-sm mr-1"></i> View Live Page
                </a>
                <a href="{{ url('/admin/satellite-imagery-add') }}" class="btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Imagery Project
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search & Filter bar -->
            <form method="GET" action="{{ url('/admin/satellite-imagery') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" 
                           placeholder="Search by title, description, sensor, resolution, or client..." 
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search fa-sm"></i> Search
                        </button>
                        @if(request('search'))
                        <a href="{{ url('/admin/satellite-imagery') }}" class="btn btn-secondary">
                            <i class="fas fa-times fa-sm"></i> Clear
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle responsive-stack-table" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="35px">#</th>
                            <th width="90px">Image</th>
                            <th>Project Title &amp; Details</th>
                            <th width="140px">Sensor / Resolution</th>
                            <th width="120px">Client / Area</th>
                            <th width="60px" class="text-center">Order</th>
                            <th width="80px" class="text-center">Status</th>
                            <th width="110px" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($imageries as $item)
                        <tr>
                            <td data-label="#">{{ $loop->iteration }}</td>
                            <td data-label="Image" class="text-center">
                                @if($item->image_url)
                                    <a href="{{ $item->image_url }}" target="_blank" title="Click to view full image">
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-thumbnail" 
                                             style="width: 70px; height: 55px; object-fit: cover; border-radius: 6px;">
                                    </a>
                                @else
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light border rounded text-muted" 
                                         style="width: 70px; height: 55px; font-size: 1.2rem;">
                                        <i class="fas fa-satellite"></i>
                                    </div>
                                @endif
                            </td>
                            <td data-label="Title & Details">
                                <div class="font-weight-bold text-dark" style="font-size: 1.05rem;">
                                    {{ $item->title }}
                                </div>
                                @if($item->category)
                                    <span class="badge badge-primary mr-1" style="font-size: 75%;">
                                        {{ $item->category }}
                                    </span>
                                @endif
                                @if($item->project_date)
                                    <span class="badge badge-light border text-muted" style="font-size: 75%;">
                                        <i class="far fa-calendar-alt mr-1"></i>{{ $item->project_date }}
                                    </span>
                                @endif
                                <div class="text-muted small mt-1" style="max-width: 480px; line-height: 1.4;">
                                    {{ Str::limit(strip_tags($item->description), 140) }}
                                </div>
                            </td>
                            <td data-label="Specs">
                                @if($item->sensor)
                                    <div class="small font-weight-bold text-dark">
                                        <i class="fas fa-satellite fa-xs text-primary mr-1"></i>{{ $item->sensor }}
                                    </div>
                                @endif
                                @if($item->resolution)
                                    <div class="small text-muted">
                                        <i class="fas fa-expand-arrows-alt fa-xs text-success mr-1"></i>{{ $item->resolution }}
                                    </div>
                                @endif
                                @if(!$item->sensor && !$item->resolution)
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td data-label="Client / Area">
                                @if($item->client)
                                    <span class="small font-weight-bold text-secondary">{{ $item->client }}</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td data-label="Order" class="text-center">
                                <span class="badge badge-secondary">{{ $item->order }}</span>
                            </td>
                            <td data-label="Status" class="text-center">
                                <form method="POST" action="{{ url('/admin/satellite-imagery-status/'.$item->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($item->status == 1)
                                        <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td data-label="Actions" class="text-center">
                                <a href="{{ url('/admin/satellite-imagery-edit/'.$item->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/satellite-imagery-delete/'.$item->id) }}" onsubmit="return confirm('Are you sure you want to delete this satellite imagery project?');">
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
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-satellite fa-3x mb-3 text-gray-400 d-block"></i>
                                <h5 class="text-gray-600">No Satellite Imagery Projects Found</h5>
                                <p class="small text-muted mb-3">Add your first high-resolution satellite imagery project to showcase on the website.</p>
                                <a href="{{ url('/admin/satellite-imagery-add') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus mr-1"></i> Add First Project
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
