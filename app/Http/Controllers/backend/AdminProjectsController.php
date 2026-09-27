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
            'client'   => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'timeline' => 'nullable|string|max:255',
        ]);

        $project = new Projects();

$project->client = $request->client;
$project->title = $request->title;
$project->timeline = $request->timeline;
$project->category = 'General';
$project->technology = 'N/A'; // <-- fixes this error
$project->details = $request->title;
$project->link = '#';
$project->is_featured = $request->has('is_featured') ? 1 : 0;
$project->status = $request->has('status') ? 1 : 0;
$project->order = 0;

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
            'client'   => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'timeline' => 'nullable|string|max:255',
        ]);

        $project = Projects::findOrFail($id);

        $project->client = $request->client;
        $project->title = $request->title;
        $project->timeline = $request->timeline;

        // Keep existing values for fields not used in the form
        $project->details = $request->title;

        $project->save();

        return redirect('/admin/projects')
            ->with('success', 'Project Record Updated Successfully');
    }

    // Delete project
    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);

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