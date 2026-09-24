<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Partners;

class AdminPartnersController extends Controller
{
    public function index()
    {
        $partners = Partners::orderBy('order', 'asc')->get();
        return view('backend.partners', compact('partners'));
    }

    public function create()
    {
        return view('backend.partner-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|in:partner,client',
            'description' => 'nullable|string',
            'website'     => 'nullable|string|max:255',
            'order'       => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $partner = new Partners();
        $partner->name        = $request->name;
        $partner->type        = $request->type;
        $partner->description = $request->description;
        $partner->website     = $request->website;
        $partner->order       = $request->order ?: 0;
        $partner->status      = $request->has('status') ? 1 : 1;

        if ($request->hasFile('image')) {
            $imageName = 'partner_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/partners'), $imageName);
            $partner->image = $imageName;
        }

        $partner->save();

        return redirect('/admin/partners')->with('success', 'Partner added successfully!');
    }

    public function edit($id)
    {
        $partner = Partners::findOrFail($id);
        return view('backend.partner-edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|in:partner,client',
            'description' => 'nullable|string',
            'website'     => 'nullable|string|max:255',
            'order'       => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $partner = Partners::findOrFail($id);
        $partner->name        = $request->name;
        $partner->type        = $request->type;
        $partner->description = $request->description;
        $partner->website     = $request->website;
        $partner->order       = $request->order ?: 0;
        $partner->status      = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = 'partner_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/partners'), $imageName);
            $partner->image = $imageName;
        }

        $partner->save();

        return redirect('/admin/partners')->with('success', 'Partner updated successfully!');
    }

    public function destroy($id)
    {
        $partner = Partners::findOrFail($id);
        $partner->delete();
        return redirect('/admin/partners')->with('success', 'Partner deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $partner = Partners::findOrFail($id);
        $partner->status = !$partner->status;
        $partner->save();
        return back()->with('success', 'Status updated successfully!');
    }
}
