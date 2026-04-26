<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller
{
    // PUBLIC: Show all published posts on homepage
    public function index()
    {
        $posts = Post::published()->paginate(9);
        return view('posts.index', compact('posts'));
    }

    // PUBLIC: Show single post detail
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();
        return view('posts.show', compact('post'));
    }

    // ADMIN: Show all posts in dashboard
    public function adminIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // ADMIN: Show create post form
    public function create()
    {
        return view('admin.posts.create');
    }

    // ADMIN: Store new post
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'excerpt'        => 'nullable|string|max:500',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category'       => 'required|string|max:100',
            'status'         => 'required|in:published,draft',
            'author'         => 'nullable|string|max:100',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')
                                 ->store('images', 'public');
        }

        Post::create([
            'title'          => $request->title,
            'excerpt'        => $request->excerpt,
            'content'        => $request->content,
            'featured_image' => $imagePath,
            'category'       => $request->category,
            'status'         => $request->status,
            'author'         => $request->author ?? 'ML Admin',
            'published_at'   => $request->status === 'published'
                                    ? Carbon::now()
                                    : null,
        ]);

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post created successfully!');
    }

    // ADMIN: Show edit form
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    // ADMIN: Update existing post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'excerpt'        => 'nullable|string|max:500',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category'       => 'required|string|max:100',
            'status'         => 'required|in:published,draft',
            'author'         => 'nullable|string|max:100',
        ]);

        $imagePath = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $imagePath = $request->file('featured_image')
                                  ->store('images', 'public');
        }

        $post->update([
            'title'          => $request->title,
            'excerpt'        => $request->excerpt,
            'content'        => $request->content,
            'featured_image' => $imagePath,
            'category'       => $request->category,
            'status'         => $request->status,
            'author'         => $request->author ?? 'ML Admin',
            'published_at'   => $request->status === 'published'
                                    ? ($post->published_at ?? Carbon::now())
                                    : null,
        ]);

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post updated successfully!');
    }

    // ADMIN: Delete post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post deleted successfully!');
    }
}
