<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\satelliteimagery;
use Illuminate\Support\Facades\File;

class satelliteimagerycontroller extends Controller
{
    /**
     * Display a listing of satellite imagery projects.
     */
    public function index(Request $request)
    {
        $query = satelliteimagery::orderBy('order', 'asc')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('client', 'like', "%{$search}%")
                  ->orWhere('sensor', 'like', "%{$search}%")
                  ->orWhere('resolution', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $imageries = $query->get();
        $totalCount = satelliteimagery::count();
        $activeCount = satelliteimagery::where('status', 1)->count();

        return view('backend.satellite-imagery', compact('imageries', 'totalCount', 'activeCount'));
    }

    /**
     * Show the form for creating a new satellite imagery project.
     */
    public function create()
    {
        return view('backend.satellite-imagery-add');
    }

    /**
     * Store a newly created satellite imagery project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'client'       => 'nullable|string|max:255',
            'resolution'   => 'nullable|string|max:100',
            'sensor'       => 'nullable|string|max:100',
            'category'     => 'nullable|string|max:100',
            'project_date' => 'nullable|string|max:100',
            'order'        => 'nullable|integer',
        ]);

        $project = new satelliteimagery();
        $project->title        = trim($request->title);
        $project->description  = trim($request->description);
        $project->client       = $request->filled('client') ? trim($request->client) : null;
        $project->resolution   = $request->filled('resolution') ? trim($request->resolution) : null;
        $project->sensor       = $request->filled('sensor') ? trim($request->sensor) : null;
        $project->category     = $request->filled('category') ? trim($request->category) : 'Optical Imagery';
        $project->project_date = $request->filled('project_date') ? trim($request->project_date) : null;
        $project->order        = $request->filled('order') ? (int)$request->order : 0;
        $project->status       = $request->has('status') ? 1 : 0;

        // Process image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/satellite_imagery');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $project->image = 'uploads/satellite_imagery/' . $fileName;
        }

        $project->save();

        return redirect('/admin/satellite-imagery')
            ->with('success', 'Satellite Imagery Project added successfully!');
    }

    /**
     * Show the form for editing the specified satellite imagery project.
     */
    public function edit($id)
    {
        $project = satelliteimagery::findOrFail($id);
        return view('backend.satellite-imagery-edit', compact('project'));
    }

    /**
     * Update the specified satellite imagery project in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'client'       => 'nullable|string|max:255',
            'resolution'   => 'nullable|string|max:100',
            'sensor'       => 'nullable|string|max:100',
            'category'     => 'nullable|string|max:100',
            'project_date' => 'nullable|string|max:100',
            'order'        => 'nullable|integer',
        ]);

        $project = satelliteimagery::findOrFail($id);
        $project->title        = trim($request->title);
        $project->description  = trim($request->description);
        $project->client       = $request->filled('client') ? trim($request->client) : null;
        $project->resolution   = $request->filled('resolution') ? trim($request->resolution) : null;
        $project->sensor       = $request->filled('sensor') ? trim($request->sensor) : null;
        $project->category     = $request->filled('category') ? trim($request->category) : 'Optical Imagery';
        $project->project_date = $request->filled('project_date') ? trim($request->project_date) : null;
        $project->order        = $request->filled('order') ? (int)$request->order : ($project->order ?: 0);
        $project->status       = $request->has('status') ? 1 : 0;

        // Process image replacement
        if ($request->hasFile('image')) {
            // Delete old file if local
            if (!empty($project->image) && !str_starts_with($project->image, 'data:')) {
                $oldPath = public_path($project->image);
                if (File::exists($oldPath)) {
                    @File::delete($oldPath);
                }
            }

            $file = $request->file('image');
            $uploadDir = public_path('uploads/satellite_imagery');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $project->image = 'uploads/satellite_imagery/' . $fileName;
        }

        $project->save();

        return redirect('/admin/satellite-imagery')
            ->with('success', 'Satellite Imagery Project updated successfully!');
    }

    /**
     * Remove the specified satellite imagery project from storage.
     */
    public function destroy($id)
    {
        $project = satelliteimagery::findOrFail($id);

        if (!empty($project->image) && !str_starts_with($project->image, 'data:')) {
            $oldPath = public_path($project->image);
            if (File::exists($oldPath)) {
                @File::delete($oldPath);
            }
        }

        $project->delete();

        return redirect('/admin/satellite-imagery')
            ->with('success', 'Satellite Imagery Project deleted successfully!');
    }

    /**
     * Toggle active/disabled status.
     */
    public function toggleStatus($id)
    {
        $project = satelliteimagery::findOrFail($id);
        $project->status = $project->status == 1 ? 0 : 1;
        $project->save();

        $statusText = $project->status == 1 ? 'activated' : 'disabled';
        return redirect()->back()
            ->with('success', "Satellite Imagery Project \"{$project->title}\" has been {$statusText}.");
    }
}

// Alias for PSR-4 PascalCase naming compatibility
if (!class_exists('App\Http\Controllers\backend\SatelliteImageryController', false)) {
    class_alias(satelliteimagerycontroller::class, 'App\Http\Controllers\backend\SatelliteImageryController');
}
