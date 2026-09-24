@extends('backend.layouts.main')
@section('title', 'Contact Inquiries')
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
                <a class="text-success" href="{{url('/admin')}}">Dashboard</a> | Contact Enquiries & Inquiries ({{ count($contacts) }})
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">#</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th width="120px">Received</th>
                            <th width="80px">Status</th>
                            <th width="110px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr class="{{ $contact->status == 'unread' ? 'table-warning font-weight-bold' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div>{{ $contact->name }}</div>
                                <small class="text-muted"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></small>
                            </td>
                            <td>{{ $contact->subject ?: 'General Inquiry' }}</td>
                            <td>
                                <div style="max-height: 80px; overflow-y: auto;">
                                    {{ $contact->message }}
                                </div>
                            </td>
                            <td><small>{{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}</small></td>
                            <td class="text-center">
                                @if($contact->status == 'unread')
                                    <span class="badge badge-warning text-dark">Unread</span>
                                @else
                                    <span class="badge badge-success">Read</span>
                                @endif
                            </td>
                            <td>
                                @if($contact->status == 'unread')
                                <form method="POST" class="d-inline" action="{{ url('/admin/contact-read/'.$contact->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-info btn-circle btn-sm" title="Mark as Read">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject) }}" class="btn btn-primary btn-circle btn-sm" title="Reply by Email">
                                    <i class="fas fa-reply"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ url('/admin/contact-delete/'.$contact->id) }}" onsubmit="return confirm('Are you sure you want to delete this message?');">
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
