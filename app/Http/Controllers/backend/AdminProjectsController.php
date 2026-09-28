<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Projects;

class AdminProjectsController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Projects::orderBy('order', 'asc')->get();

        return view('backend.projects', compact('projects'));
    }

    // Show Add Project form
    public function addProject()
    {
        return view('backend.project-add');
    }

    // Save new project
    public function submitProjectRecord(Request $request)
    {
        $request->validate([
            'client'      => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'timeline'    => 'nullable|string|max:255',
            'details'     => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $project = new Projects();

        $project->client      = $request->client;
        $project->title       = $request->title;
        $project->timeline    = $request->timeline;
        $project->document    = null;
        $project->details     = $request->details ?: $request->title;
        $project->key_terms   = null;
        $project->category    = 'General';
        $project->technology  = 'N/A';
        $project->link        = '#';
        $project->order       = $request->filled('order') ? (int)$request->order : 0;
        $project->is_featured = $request->has('is_featured') ? 1 : 0;
        $project->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());
            $image->move(public_path('uploads/projects'), $name);
            $project->image = $name;
        }

        $project->save();

        return redirect('/admin/projects')
            ->with('success', 'Project Record Added Successfully');
    }

    // Show Edit Project form
    public function editProject($id)
    {
        $project = Projects::findOrFail($id);

        return view('backend.project-edit', compact('project'));
    }

    // Update existing project
    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'client'      => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'timeline'    => 'nullable|string|max:255',
            'details'     => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $project = Projects::findOrFail($id);

        $project->client      = $request->client;
        $project->title       = $request->title;
        $project->timeline    = $request->timeline;
        $project->details     = $request->details ?: $request->title;
        $project->order       = $request->filled('order') ? (int)$request->order : ($project->order ?: 0);
        $project->is_featured = $request->has('is_featured') ? 1 : 0;
        $project->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            // Delete old uploaded image if exists
            if ($project->image && file_exists(public_path('uploads/projects/' . $project->image))) {
                @unlink(public_path('uploads/projects/' . $project->image));
            }

            $image = $request->file('image');
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());
            $image->move(public_path('uploads/projects'), $name);
            $project->image = $name;
        }

        $project->save();

        return redirect('/admin/projects')
            ->with('success', 'Project Record Updated Successfully');
    }

    // Delete project
    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);

        if ($project->image && file_exists(public_path('uploads/projects/' . $project->image))) {
            @unlink(public_path('uploads/projects/' . $project->image));
        }

        $project->delete();

        return redirect('/admin/projects')
            ->with('success', 'Project Record Deleted Successfully');
    }

    // Toggle project status
    public function toggleStatus($id)
    {
        $project = Projects::findOrFail($id);

        $project->status = !$project->status;
        $project->save();

        return back()->with('success', 'Status updated successfully!');
    }
}