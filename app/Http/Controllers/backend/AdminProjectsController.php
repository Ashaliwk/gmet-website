<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Projects;

class AdminProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::orderBy('order', 'asc')->get();
        return view('backend.projects', compact('projects'));
    }

    public function addProject()
    {
        return view('backend.project-add');
    }

    public function submitProjectRecord(Request $request)
    {
        $request->validate([
            'client'    => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'document'  => 'nullable|string|max:255',
            'timeline'  => 'nullable|string|max:255',
            'key_terms' => 'nullable|string',
            'details'   => 'nullable|string',
            'category'  => 'nullable|string|max:100',
            'order'     => 'nullable|integer',
            'image'     => 'nullable|mimes:jpeg,jpg,png,gif|max:10240'
        ]);

        $project = new Projects();
        $project->client      = $request->client;
        $project->title       = $request->title;
        $project->document    = $request->document;
        $project->timeline    = $request->timeline;
        $project->key_terms   = $request->key_terms;
        $project->details     = $request->details ?: $request->title;
        $project->category    = $request->category;
        $project->technology  = $request->technology;
        $project->link        = $request->link ?: '#';
        $project->is_featured = $request->has('is_featured') ? 1 : 0;
        $project->status      = $request->has('status') ? 1 : 1;
        $project->order       = $request->order ?: 0;

        if ($request->hasFile('image')) {
            $imageName = 'gmet_project_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/projects'), $imageName);
            $project->image = $imageName;
        }

        $project->save();

        return redirect('/admin/projects')->with('success', 'Project Record Added Successfully');
    }

    public function editProject($id)
    {
        $project = Projects::findOrFail($id);
        return view('backend.project-edit', compact('project'));
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'client'    => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'document'  => 'nullable|string|max:255',
            'timeline'  => 'nullable|string|max:255',
            'key_terms' => 'nullable|string',
            'details'   => 'nullable|string',
            'category'  => 'nullable|string|max:100',
            'order'     => 'nullable|integer',
            'image'     => 'nullable|mimes:jpeg,jpg,png,gif|max:10240'
        ]);

        $project = Projects::findOrFail($id);
        $project->client      = $request->client;
        $project->title       = $request->title;
        $project->document    = $request->document;
        $project->timeline    = $request->timeline;
        $project->key_terms   = $request->key_terms;
        $project->details     = $request->details ?: $request->title;
        $project->category    = $request->category;
        $project->technology  = $request->technology;
        $project->link        = $request->link ?: '#';
        $project->is_featured = $request->has('is_featured') ? 1 : 0;
        $project->status      = $request->has('status') ? 1 : 0;
        $project->order       = $request->order ?: 0;

        if ($request->hasFile('image')) {
            $imageName = 'gmet_project_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/projects'), $imageName);
            $project->image = $imageName;
        }

        $project->save();

        return redirect('/admin/projects')->with('success', 'Project Record Updated Successfully');
    }

    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();
        return redirect('/admin/projects')->with('success', 'Project Record Deleted Successfully');
    }

    public function toggleStatus($id)
    {
        $project = Projects::findOrFail($id);
        $project->status = !$project->status;
        $project->save();
        return back()->with('success', 'Status updated successfully!');
    }
}
