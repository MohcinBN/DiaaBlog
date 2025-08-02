<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Posts\PostStoreRequest;
use App\Http\Requests\Posts\PostUpdateRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $posts = Post::with('categories')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(PostStoreRequest $request)
    {
        $postData = $request->validated();
        $postData['user_id'] = Auth::id();

        if ($request->hasFile('featured_image')) {
            $postData['featured_image'] = $this->imageService->storeImage($request->file('featured_image'));
        }

        $postData['slug'] = Str::slug($postData['title']);

        $categoryIds = $request->categories;

        unset($postData['categories']);

        $post = Post::create($postData);

        // attach categories to post using the pivot table
        $post->categories()->attach($categoryIds);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $postData = $request->validated();

        if ($request->hasFile('featured_image')) {
            $postData['featured_image'] = $this->imageService->updateImage(
                $post->featured_image,
                $request->file('featured_image')
            );
        }

        $post->update($postData);

        // update categories if needed
        $post->categories()->sync($request->categories);

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

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
