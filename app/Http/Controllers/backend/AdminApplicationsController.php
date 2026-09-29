<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Application;
use App\Models\backend\ApplicationRegistration;

class AdminApplicationsController extends Controller
{
    /**
     * Display all applications
     */
    public function index(Request $request)
    {
        $query = Application::withCount('registrations')->orderBy('order', 'asc')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('app_number', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $applications = $query->get();
        $totalApps = Application::count();
        $activeApps = Application::where('status', 1)->count();
        $totalRegistrations = ApplicationRegistration::count();

        return view('backend.applications', compact('applications', 'totalApps', 'activeApps', 'totalRegistrations'));
    }

    /**
     * Show form to create new application
     */
    public function create()
    {
        // Suggest next app number
        $nextId = (Application::max('id') ?? 0) + 1;
        $suggestedNumber = 'APP-' . str_pad($nextId, 2, '0', STR_PAD_LEFT);

        return view('backend.application-add', compact('suggestedNumber'));
    }

    /**
     * Store a newly created application
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'app_number'  => 'nullable|string|max:50',
            'description' => 'required|string',
            'app_link'    => 'nullable|string|max:1000',
            'category'    => 'nullable|string|max:100',
            'technology'  => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $app = new Application();
        $app->title       = $request->title;
        $app->app_number  = $request->filled('app_number') ? trim($request->app_number) : null;
        $app->description = $request->description;
        $app->app_link    = $request->filled('app_link') ? trim($request->app_link) : null;
        $app->category    = $request->filled('category') ? trim($request->category) : 'Web GIS & Tech';
        $app->technology  = $request->filled('technology') ? trim($request->technology) : null;
        $app->order       = $request->filled('order') ? (int)$request->order : 0;
        $app->is_featured = $request->has('is_featured') ? 1 : 0;
        $app->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $app->image = 'data:' . $image->getMimeType() . ';base64,' .
                base64_encode(file_get_contents($image->getRealPath()));
        }

        $app->save();

        return redirect('/admin/applications')
            ->with('success', 'Application added successfully! You can attach or update the application link anytime.');
    }

    /**
     * Show form to edit application
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);
        return view('backend.application-edit', compact('application'));
    }

    /**
     * Update existing application
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'app_number'  => 'nullable|string|max:50',
            'description' => 'required|string',
            'app_link'    => 'nullable|string|max:1000',
            'category'    => 'nullable|string|max:100',
            'technology'  => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $app = Application::findOrFail($id);
        $app->title       = $request->title;
        $app->app_number  = $request->filled('app_number') ? trim($request->app_number) : null;
        $app->description = $request->description;
        $app->app_link    = $request->filled('app_link') ? trim($request->app_link) : null;
        $app->category    = $request->filled('category') ? trim($request->category) : 'Web GIS & Tech';
        $app->technology  = $request->filled('technology') ? trim($request->technology) : null;
        $app->order       = $request->filled('order') ? (int)$request->order : ($app->order ?: 0);
        $app->is_featured = $request->has('is_featured') ? 1 : 0;
        $app->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $app->image = 'data:' . $image->getMimeType() . ';base64,' .
                base64_encode(file_get_contents($image->getRealPath()));
        }

        $app->save();

        return redirect('/admin/applications')
            ->with('success', 'Application details and link updated successfully.');
    }

    /**
     * Toggle application status (active/disabled)
     */
    public function toggleStatus($id)
    {
        $app = Application::findOrFail($id);
        $app->status = $app->status == 1 ? 0 : 1;
        $app->save();

        $statusText = $app->status == 1 ? 'activated' : 'disabled';
        return redirect()->back()
            ->with('success', "Application '{$app->title}' {$statusText} successfully.");
    }

    /**
     * Delete application
     */
    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $title = $app->title;
        $app->delete();

        return redirect('/admin/applications')
            ->with('success', "Application '{$title}' and its registration records were deleted.");
    }

    /**
     * View all registered users information
     */
    public function registrations(Request $request)
    {
        $query = ApplicationRegistration::with('application')->orderBy('created_at', 'desc');

        if ($request->filled('application_id')) {
            $query->where('application_id', $request->application_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('organization', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%");
            });
        }

        $registrations = $query->get();
        $applications = Application::orderBy('title', 'asc')->get();
        $selectedApp = $request->filled('application_id') ? Application::find($request->application_id) : null;

        return view('backend.application-registrations', compact('registrations', 'applications', 'selectedApp'));
    }

    /**
     * Delete single registration record
     */
    public function deleteRegistration($id)
    {
        $reg = ApplicationRegistration::findOrFail($id);
        $reg->delete();

        return redirect()->back()
            ->with('success', 'User registration record deleted successfully.');
    }
}
