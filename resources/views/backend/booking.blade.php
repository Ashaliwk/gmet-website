@extends('backend.layouts.main')
@section('title', 'Bookings')
@section('main-container')
            <div class="container-fluid"><br>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><a class="text-success" href="{{url('/admin')}}">Main Menu</a> | Booking List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking ID</th>
                                    <th>Room</th>
                                    <th>Guest</th>
                                    <th>Contact</th>
                                    <th>Stay</th>
                                    <th>Total</th>
                                    <th>Booking Status</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->room->name ?? 'Room removed' }}</td>
                                    <td>
                                        <strong>{{ $booking->guest_name }}</strong>
                                        <br>
                                        <small>{{ $booking->guests }} guest(s)</small>
                                    </td>
                                    <td>
                                        {{ $booking->guest_email }}
                                        <br>
                                        <small>{{ $booking->guest_phone }}</small>
                                    </td>
                                    <td>
                                        {{ optional($booking->check_in)->format('M d, Y') }}
                                        <br>
                                        <small>to {{ optional($booking->check_out)->format('M d, Y') }}</small>
                                    </td>
                                    <td>{{ number_format((float) $booking->total_price, 2) }}</td>
                                    <td>
                                        @php($bookingStatus = strtolower((string) $booking->status))
                                        @if($bookingStatus === 'confirmed')
                                            <span class="badge badge-success p-2 text-uppercase">{{ $booking->status }}</span>
                                        @elseif($bookingStatus === 'cancelled')
                                            <span class="badge badge-danger p-2 text-uppercase">{{ $booking->status }}</span>
                                        @else
                                            <span class="badge badge-warning p-2 text-uppercase">{{ $booking->status }}</span>
                                        @endif
                                        <div class="mt-1">
                                            @if($booking->is_verified)
                                                <span class="badge badge-light border text-success" style="font-size: 11px;"><i class="fas fa-check-circle"></i> Email Verified</span>
                                            @else
                                                <span class="badge badge-light border text-danger" style="font-size: 11px;"><i class="fas fa-times-circle"></i> Unverified</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($booking->review)
                                            <div>
                                                <span class="badge {{ $booking->review->status == 1 ? 'badge-success' : 'badge-secondary' }} p-2">
                                                    {{ $booking->review->status == 1 ? 'Published' : 'Hidden' }}
                                                </span>
                                            </div>
                                            <a href="{{ url('/admin/reviews') }}" class="btn btn-success btn-sm mt-2">Manage Review</a>
                                        @else
                                            <span class="badge badge-light p-2">No review yet</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No room bookings found yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
