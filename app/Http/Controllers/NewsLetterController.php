<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use App\Http\Requests\NewsLetter\StoreNewsLetterRequest;
use App\Http\Requests\NewsLetter\UpdateNewsLetterRequest;
use App\Services\ExportCSV;

class NewsLetterController extends Controller
{
    public function index()
    {
        $newsLetters = NewsLetter::paginate(5);
        return view('News-letters.index', compact('newsLetters'));
    }

    public function create()
    {
        return view('News-letters.create');
    }

    public function store(StoreNewsLetterRequest $request)
    {
        $request->validated();

        $newsLetter = new NewsLetter();
        $newsLetter->name = $request->name;
        $newsLetter->email = $request->email;
        $newsLetter->save();

        return redirect()->back()->with('success', 'Thank you for your subscription');
    }

    public function destroy(NewsLetter $newsLetter)
    {
        $newsLetter->delete();
        return redirect()->route('newsLetters.index')->with('success', 'NewsLetter deleted successfully');
    }

    /** 
     * This is a public route for embedding the news letter form in the website
     * you can use it in any view by using the following code
     * @include('News-letters.embed-form')
     * <x-newsletter-embed-form />
     * iframe it: <iframe src="{{ route('newsLetter.embed-form') }}"></iframe>
     */
    public function embedForm()
    {
        return view('News-letters.embed-form');
    }

    public function export()
    {
        return (new ExportCSV)->export(NewsLetter::class);
    }
}
