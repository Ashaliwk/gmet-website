<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Services;

class AdminServicesController extends Controller
{
    public function index()
    {
        $services = Services::orderBy('order', 'asc')->get();

        return view('backend.services', compact('services'));
    }

    public function create()
    {
        return view('backend.service-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'    => 'nullable|string|max:100',
            'order'       => 'nullable|integer',
        ]);

        // Convert uploaded image to Base64
        $imageData = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageData = 'data:' . $image->getMimeType() . ';base64,' .
                base64_encode(file_get_contents($image->getRealPath()));
        }

        $service = Services::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imageData,
            'category'    => $request->category,
            'order'       => $request->order ?: 0,
            'status'      => $request->has('status') ? 1 : 0,
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service added successfully!');
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);

        return view('backend.service-edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'    => 'nullable|string|max:100',
            'order'       => 'nullable|integer',
        ]);

        $service = Services::findOrFail($id);

        $imageData = $service->image;

        // If a new image was uploaded, convert it to Base64
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageData = 'data:' . $image->getMimeType() . ';base64,' .
                base64_encode(file_get_contents($image->getRealPath()));
        }

        $service->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imageData,
            'category'    => $request->category,
            'order'       => $request->order ?: 0,
            'status'      => $request->has('status') ? 1 : 0,
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Services::findOrFail($id);

        $service->delete();

        return redirect('/admin/services')
            ->with('success', 'Service deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $service = Services::findOrFail($id);

        $service->status = !$service->status;
        $service->save();

        return back()->with('success', 'Status updated successfully!');
    }
}