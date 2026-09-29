@extends('backend.layouts.main')
@section('title', 'Registered Users - Applications')
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

    <!-- Heading & Quick Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h6 class="m-0 font-weight-bold text-success">
                    <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | 
                    <a class="text-success" href="{{url('/admin/applications')}}">Applications</a> | 
                    Registered Users ({{ count($registrations) }})
                </h6>
                @if($selectedApp)
                    <small class="text-primary font-weight-bold mt-1 d-block">
                        <i class="fas fa-filter mr-1"></i> Filtering by Application: <u>{{ $selectedApp->title }}</u> ({{ $selectedApp->display_number }})
                        <a href="{{ url('/admin/application-registrations') }}" class="badge badge-secondary ml-2">Clear Filter</a>
                    </small>
                @endif
            </div>

            <!-- Filter Dropdown Form -->
            <form method="GET" action="{{ url('/admin/application-registrations') }}" class="form-inline mt-2 mt-sm-0">
                <label class="mr-2 small font-weight-bold text-gray-700">Filter App:</label>
                <select name="application_id" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="">-- All Applications --</option>
                    @foreach($applications as $appOption)
                        <option value="{{ $appOption->id }}" {{ request('application_id') == $appOption->id ? 'selected' : '' }}>
                            {{ $appOption->display_number }} - {{ Str::limit($appOption->title, 35) }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ url('/admin/application-add') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add App
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover responsive-stack-table align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="35px">#</th>
                            <th>User Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
                            <th>Organization</th>
                            <th>Application Registered</th>
                            <th>Purpose / Notes</th>
                            <th width="125px">Date & Time</th>
                            <th width="75px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                        <tr>
                            <td data-label="#">{{ $loop->iteration }}</td>
                            <td data-label="User Name">
                                <span class="font-weight-bold text-dark">{{ $reg->name }}</span>
                                @if($reg->designation)
                                    <small class="d-block text-muted">{{ $reg->designation }}</small>
                                @endif
                            </td>
                            <td data-label="Email">
                                <a href="mailto:{{ $reg->email }}" class="text-success font-weight-bold">
                                    <i class="fas fa-envelope fa-sm mr-1"></i> {{ $reg->email }}
                                </a>
                            </td>
                            <td data-label="Phone">
                                @if($reg->phone)
                                    <a href="tel:{{ $reg->phone }}" class="text-muted">
                                        <i class="fas fa-phone fa-sm mr-1"></i> {{ $reg->phone }}
                                    </a>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td data-label="Organization">
                                @if($reg->organization)
                                    <span class="badge badge-light border text-dark">{{ $reg->organization }}</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td data-label="Application">
                                @if($reg->application)
                                    <a href="{{ url('/admin/application-edit/'.$reg->application->id) }}" class="font-weight-bold text-dark" title="Edit App">
                                        <span class="badge badge-success px-2 py-1 mr-1">{{ $reg->application->display_number }}</span>
                                        {{ Str::limit($reg->application->title, 28) }}
                                    </a>
                                @else
                                    <span class="badge badge-secondary">Application Removed</span>
                                @endif
                            </td>
                            <td data-label="Purpose">
                                @if($reg->purpose)
                                    <small class="text-secondary" title="{{ $reg->purpose }}">
                                        {{ Str::limit($reg->purpose, 80) }}
                                    </small>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td data-label="Date">
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ $reg->created_at ? $reg->created_at->format('M d, Y') : 'N/A' }}
                                    <div class="text-gray-500" style="font-size: 11px;">
                                        <i class="far fa-clock mr-1"></i> {{ $reg->created_at ? $reg->created_at->format('h:i A') : '' }}
                                    </div>
                                </small>
                            </td>
                            <td data-label="Action" class="text-center">
                                <form method="POST" action="{{ url('/admin/application-registration-delete/'.$reg->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user registration record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Delete Registration Record">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash fa-2x mb-2 text-muted d-block"></i>
                                @if($selectedApp)
                                    No registrations yet for <strong>{{ $selectedApp->title }}</strong>.
                                @else
                                    No user registrations recorded yet for any application.
                                @endif
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
