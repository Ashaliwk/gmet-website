<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        if (! $request->session()->exists('email')) {
            return view('backend.login');
        }

        $bookings = Booking::with(['room', 'review'])
            ->latest()
            ->get();

        return view('backend.booking', compact('bookings'));
    }
}
