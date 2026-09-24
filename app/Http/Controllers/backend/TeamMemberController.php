<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Team;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('order', 'asc')->get();
        return view('backend.team', compact('teams'));
    }

    public function create()
    {
        return view('backend.team-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname'    => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email'       => 'nullable|email',
            'intro'       => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $team = new Team();
        $team->fullname    = $request->fullname;
        $team->email       = $request->email ?: '';
        $team->designation = $request->designation;
        $team->intro       = $request->intro;
        $team->insta       = $request->insta;
        $team->linkedin    = $request->linkedin;
        $team->order       = $request->order ?: 0;
        $team->status      = $request->has('status') ? 1 : 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/team'), $name);
            $team->image = $name;
        }

        $team->save();

        return redirect('/admin/team')->with('success', 'Team Member Added Successfully');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.team-edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname'    => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email'       => 'nullable|email',
            'intro'       => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'order'       => 'nullable|integer',
        ]);

        $team = Team::findOrFail($id);
        $team->fullname    = $request->fullname;
        $team->email       = $request->email ?: '';
        $team->designation = $request->designation;
        $team->intro       = $request->intro;
        $team->insta       = $request->insta;
        $team->linkedin    = $request->linkedin;
        $team->order       = $request->order ?: 0;
        $team->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/team'), $name);
            $team->image = $name;
        }

        $team->save();

        return redirect('/admin/team')->with('success', 'Team Member Updated Successfully');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        return redirect('/admin/team')->with('success', 'Team Member Deleted Successfully');
    }

    public function toggleStatus($id)
    {
        $team = Team::findOrFail($id);
        $team->status = !$team->status;
        $team->save();
        return back()->with('success', 'Status updated successfully!');
    }
}
