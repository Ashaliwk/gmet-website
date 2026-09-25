<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /** Show list of blogs in admin panel */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.blog_index', compact('blogs'));
    }

    /** Show form to create a new blog */
    public function create()
    {
        return view('backend.blog_create');
    }

    /** Store a new blog */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('blog_images', 'public');
        }

        Blog::create($validated);
        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post created successfully.');
    }

    /** Show form to edit a blog */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blog_edit', compact('blog'));
    }

    /** Update a blog */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')
                ->store('blog_images', 'public');
        }

        $blog->update($validated);
        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post updated successfully.');
    }

    /** Delete a blog */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post deleted.');
    }
}
?>
