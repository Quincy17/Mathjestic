<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index() {
        $blogs = BlogModel::latest()->paginate(5);
        $mathBlogs = BlogModel::where('category', 'Matematika')->latest()->take(3)->get(); // Ambil 3 blog dengan kategori Matematika
        return view('blogs.index', compact('blogs', 'mathBlogs'));
    }

    public function create() {
        return view('blogs.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255', // Validasi kategori
            'image' => 'nullable|image|max:4096'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        BlogModel::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category, // Simpan kategori
            'image' => $imagePath
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil diposting!');
    }

    public function show($id) {
        $blog = BlogModel::find($id);

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog tidak ditemukan');
        }

        return view('blogs.show', compact('blog'));
    }

    public function edit(BlogModel $blog) {
        if (Auth::id() !== $blog->user_id) {
            abort(403);
        }
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, BlogModel $blog) {
        if (Auth::id() !== $blog->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255', // Validasi kategori
            'image' => 'nullable|image|max:4096'
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('blog_images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category, // Update kategori
            'image' => $blog->image
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil diperbarui!');
    }

    public function destroy(BlogModel $blog) {
        if (Auth::id() !== $blog->user_id) {
            abort(403);
        }

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dihapus!');
    }
}
