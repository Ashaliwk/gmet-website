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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | GMET Projects List ({{ count($projects) }})
            </h6>
            <a href="{{url('/admin/project-add')}}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Project
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="35px">#</th>
                            <th>Client</th>
                            <th>Project / Description</th>
                            <th>Document</th>
                            <th>Timeline</th>
                            <th>Key Terms</th>
                            <th width="70px">Featured</th>
                            <th width="70px">Status</th>
                            <th width="120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $proj)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold text-dark">{{ $proj->client }}</td>
                            <td>{{ $proj->title }}</td>
                            <td><span class="badge badge-secondary">{{ $proj->document ?: 'N/A' }}</span></td>
                            <td><small class="text-muted">{{ $proj->timeline ?: 'N/A' }}</small></td>
                            <td><small>{{ Str::limit($proj->key_terms, 80) }}</small></td>
                            <td class="text-center">
                                @if($proj->is_featured)
                                    <span class="badge badge-warning text-dark">Highlight</span>
                                @else
                                    <span class="badge badge-light">Standard</span>
                                @endif
                            </td>
                            <td class="text-center">
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
                            <td>
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
@endsection
