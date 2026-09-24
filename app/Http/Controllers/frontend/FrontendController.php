<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Services;
use App\Models\backend\Team;
use App\Models\backend\Projects;
use App\Models\backend\Partners;
use App\Models\backend\Contact;

class FrontendController extends Controller
{
    public function index()
    {
        $services = Services::where('status', 1)->orderBy('order', 'asc')->take(6)->get();
        $team = Team::where('status', 1)->orderBy('order', 'asc')->take(4)->get();
        $featuredProjects = Projects::where('status', 1)->where('is_featured', 1)->orderBy('order', 'asc')->take(3)->get();
        $partners = Partners::where('status', 1)->orderBy('order', 'asc')->get();

        return view('frontend.index', compact('services', 'team', 'featuredProjects', 'partners'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        $services = Services::where('status', 1)->orderBy('order', 'asc')->get();
        return view('frontend.services', compact('services'));
    }

    public function team()
    {
        $team = Team::where('status', 1)->orderBy('order', 'asc')->get();
        return view('frontend.team', compact('team'));
    }

    public function projects()
    {
        $projects = Projects::where('status', 1)->orderBy('order', 'asc')->get();
        $featuredProjects = Projects::where('status', 1)->where('is_featured', 1)->orderBy('order', 'asc')->get();
        return view('frontend.projects', compact('projects', 'featuredProjects'));
    }

    public function partners()
    {
        $partners = Partners::where('status', 1)->where('type', 'partner')->orderBy('order', 'asc')->get();
        $clients = Partners::where('status', 1)->where('type', 'client')->orderBy('order', 'asc')->get();
        return view('frontend.partners', compact('partners', 'clients'));
    }

    public function resources()
    {
        return view('frontend.resources');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject ?: 'General Inquiry',
            'message' => $request->message,
            'status'  => 'unread',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your enquiry has been received. Our team will contact you shortly.');
    }

    // JSON API Endpoints for external or headless access
    public function apiServices()
    {
        return response()->json(Services::where('status', 1)->orderBy('order', 'asc')->get());
    }

    public function apiTeam()
    {
        return response()->json(Team::where('status', 1)->orderBy('order', 'asc')->get());
    }

    public function apiProjects()
    {
        return response()->json(Projects::where('status', 1)->orderBy('order', 'asc')->get());
    }

    public function apiPartners()
    {
        return response()->json(Partners::where('status', 1)->orderBy('order', 'asc')->get());
    }
}
