<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use App\Http\Requests\StaticPages\StaticPageStoreRequest;
use App\Http\Requests\StaticPages\StaticPageUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    protected $isAdmin;

    public function __construct()
    {
        $this->isAdmin = Auth::check() && Auth::user()->is_admin == 1;
    }
    
    /**
     * Display a listing of static pages.
     */
    public function index()
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        return view('static-pages.index', [
            'staticPages' => StaticPage::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new static page.
     */
    public function create()
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        return view('static-pages.create');
    }

    /**
     * Store a newly created static page in storage.
     */
    public function store(StaticPageStoreRequest $request)
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        $request->validated();

        $staticPage = new StaticPage();
        $staticPage->title = $request->title;
        $staticPage->content = $request->content;
        $staticPage->is_published = $request->has('is_published') ? $request->is_published : true;
        
        // Generate slug if not provided
        if ($request->filled('slug')) {
            $staticPage->slug = Str::slug($request->slug);
        } else {
            $staticPage->slug = Str::slug($request->title);
        }

        $staticPage->save();

        return redirect()->route('static-pages.index')->with('success', 'Page created successfully');
    }

    /**
     * Display the specified static page.
     */
    public function show($slug)
    {
        $staticPage = StaticPage::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        return view('static-pages.show', [
            'page' => $staticPage
        ]);
    }

    /**
     * Show the form for editing the specified static page.
     */
    public function edit(StaticPage $staticPage)
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        return view('static-pages.edit', [
            'page' => $staticPage
        ]);
    }

    /**
     * Update the specified static page in storage.
     */
    public function update(StaticPageUpdateRequest $request, StaticPage $staticPage)
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        $request->validated();

        $staticPage->title = $request->title;
        $staticPage->content = $request->content;
        $staticPage->is_published = $request->has('is_published') ? $request->is_published : $staticPage->is_published;
        
        // Update slug if provided
        if ($request->filled('slug')) {
            $staticPage->slug = Str::slug($request->slug);
        } else if ($staticPage->title !== $request->title) {
            $staticPage->slug = Str::slug($request->title);
        }

        $staticPage->update();

        return redirect()->route('static-pages.index')->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified static page from storage.
     */
    public function destroy(StaticPage $staticPage)
    {
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
        
        $staticPage->delete();

        return redirect()->route('static-pages.index')->with('success', 'Page deleted successfully');
    }
}
