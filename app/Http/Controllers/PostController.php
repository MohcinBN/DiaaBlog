<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $posts = Post::paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('images', 'public');
        }

        $slug = Str::slug($request->title);

        $post = Post::create([
            'title' => $request->title,
            'slug'=>$slug,
            'content' => $request->content,
            'featured_image' => $imagePath ?? null,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('images', 'public');
            $post->featured_image = $imagePath;
        }

        $slug = Str::slug($request->title);

        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPosts() {
        $posts = Post::all();
        dd($posts);
        return view('welcome', compact('posts'));
   }

   //public function getAllPosts(Post $post)
//{
    //$allPosts = Post::latest()->get(); // récupère tous les articles

    //return view('posts.show', compact('allPosts'));
//}

   public function show($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail(); // read article
    //dd($post);
   
    return view('posts.show', compact('post'));
}

}
