<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Services;
use App\Models\backend\Team;
use App\Models\backend\Projects;
use App\Models\backend\Partners;
use App\Models\backend\Contact;
use App\Models\backend\Application;
use App\Models\backend\ApplicationRegistration;
use App\Models\backend\satelliteimagery;

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
    $team = Team::where('status', 1)->orderBy('order', 'asc')->get();
    return view('frontend.about', compact('team'));
}

    public function services()
    {
        $services = Services::where('status', 1)->orderBy('order', 'asc')->get();
        return view('frontend.services', compact('services'));
    }

    public function projects()
    {
        $projects = Projects::where('status', 1)->orderBy('order', 'asc')->get();
        $featuredProjects = Projects::where('status', 1)->where('is_featured', 1)->orderBy('order', 'asc')->get();
        return view('frontend.projects', compact('projects', 'featuredProjects'));
    }

    public function applications()
    {
        $applications = Application::where('status', 1)->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        return view('frontend.applications', compact('applications'));
    }

    public function showRegistrationForm($id)
    {
        $application = Application::where('status', 1)->findOrFail($id);
        return view('frontend.application-register', compact('application'));
    }

    public function applicationRegister(Request $request, $id)
    {
        $app = Application::where('status', 1)->findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'designation'  => 'nullable|string|max:255',
            'purpose'      => 'nullable|string|max:1000',
        ]);

        $registration = ApplicationRegistration::create([
            'application_id' => $app->id,
            'name'           => trim($request->name),
            'email'          => strtolower(trim($request->email)),
            'phone'          => $request->filled('phone') ? trim($request->phone) : null,
            'organization'   => $request->filled('organization') ? trim($request->organization) : null,
            'designation'    => $request->filled('designation') ? trim($request->designation) : null,
            'purpose'        => $request->filled('purpose') ? trim($request->purpose) : null,
            'ip_address'     => $request->ip(),
            'user_agent'     => $request->userAgent(),
        ]);

        // Save session flag indicating user has registered for this app
        session()->put("registered_app_{$app->id}", true);
        session()->put("registered_user_email", $registration->email);
        session()->put("registered_user_name", $registration->name);

        $appLink = $app->app_link;
        $targetUrl = null;
        if (!empty($appLink) && $appLink !== '#') {
            if (!preg_match("~^(?:f|ht)tps?://~i", $appLink) && !str_starts_with($appLink, '/')) {
                $targetUrl = "https://" . $appLink;
            } else {
                $targetUrl = $appLink;
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'       => true,
                'message'       => 'Registration successful! Moving to application...',
                'app_title'     => $app->title,
                'app_number'    => $app->display_number,
                'app_link'      => $targetUrl ?: $app->app_link,
                'has_link'      => !empty($targetUrl),
                'redirect_url'  => $targetUrl,
                'user_name'     => $registration->name,
                'user_email'    => $registration->email,
            ]);
        }

        if (!empty($targetUrl)) {
            return redirect()->away($targetUrl);
        }

        return redirect()->route('frontend.applications.register.form', $app->id)
            ->with('success', 'Registration completed successfully! Your details have been recorded. The application link is currently being configured by GMET administration.');
    }

    public function partners()
    {
        $partners = Partners::where('status', 1)->where('type', 'partner')->orderBy('order', 'asc')->get();
        $clients = Partners::where('status', 1)->where('type', 'client')->orderBy('order', 'asc')->get();
        return view('frontend.partners', compact('partners', 'clients'));
    }

    public function satelliteimagery()
    {
        $imageryProjects = satelliteimagery::where('status', 1)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.satelliteimagery', compact('imageryProjects'));
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

    public function apiSatelliteImagery()
    {
        return response()->json(satelliteimagery::where('status', 1)->orderBy('order', 'asc')->get());
    }
}
