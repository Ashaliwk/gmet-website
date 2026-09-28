@extends('backend.layouts.main')
@section('title', 'Projects')
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
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Projects List ({{ count($projects) }})
            </h6>
            <a href="{{url('/admin/project-add')}}" class="btn btn-sm btn-success shadow-sm mt-2 mt-sm-0">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Project
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover responsive-stack-table align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="35px">#</th>
                            <th width="75px">Image</th>
                            <th>Client</th>
                            <th>Project Title</th>
                            <th>Timeline</th>
                            <th width="90px">Status</th>
                            <th width="120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $proj)
                        <tr>
                            <td data-label="#">{{ $loop->iteration }}</td>
                            <td data-label="Image" class="text-center">
                                @if($proj->image_url)
                                    <img src="{{ $proj->image_url }}" alt="{{ $proj->title }}" class="img-thumbnail" style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light border rounded text-muted" style="width: 55px; height: 55px; font-size: 1.2rem;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td data-label="Client" class="font-weight-bold text-dark">{{ $proj->client }}</td>
                            <td data-label="Title">
                                <div><strong>{{ $proj->title }}</strong></div>
                                @if($proj->details && $proj->details !== $proj->title)
                                    <small class="text-muted">{{ Str::limit($proj->details, 80) }}</small>
                                @endif
                            </td>
                            <td data-label="Timeline"><small class="text-muted">{{ $proj->timeline ?: 'N/A' }}</small></td>
                            <td data-label="Status" class="text-center">
                                <form method="POST" action="{{ url('/admin/project-status/'.$proj->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($proj->status == 1)
                                        <button type="submit" class="btn btn-sm btn-success badge-status" title="Click to disable">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary badge-status" title="Click to activate">Disabled</button>
                                    @endif
                                </form>
                            </td>
                            <td data-label="Actions">
                                <a href="{{ url('/admin/project-edit/'.$proj->id) }}" class="btn btn-success btn-circle btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/project-delete/'.$proj->id) }}" onsubmit="return confirm('Are you sure you want to delete this project?');">
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

@push('styles')
<style>
    /* Responsive stacked table for small screens */
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
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .responsive-stack-table td {
            text-align: right;
            padding: 0.6rem 0.9rem;
            border: none;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
        }
        .responsive-stack-table td:last-child {
            border-bottom: none;
        }
        .responsive-stack-table td::before {
            content: attr(data-label);
            float: left;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.03em;
        }
        .responsive-stack-table td[data-label="Actions"],
        .responsive-stack-table td[data-label="Status"],
        .responsive-stack-table td[data-label="Featured"],
        .responsive-stack-table td[data-label="Image"] {
            text-align: right;
        }
    }

    .badge-status {
        min-width: 70px;
    }
</style>
@endpush
@endsection