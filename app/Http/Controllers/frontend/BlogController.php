<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.blog', compact('blogs'));
    }

    /**
     * Display a single blog post.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('frontend.blog_show', compact('blog'));
    }
}
?>
