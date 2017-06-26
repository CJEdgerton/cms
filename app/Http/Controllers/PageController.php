<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Requests\StoresPage;
use App\Http\Requests\UpdatesPage;
use App\Http\Requests\DestroysPage;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth')->except('showPage');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->is_admin )
            $pages = Page::latest()->paginate(10);
        else
            $pages = Page::where('created_by', auth()->id())->latest()->paginate(10); 

        return view('content-management.pages.index')
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('content-management.pages.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresPage $request)
    {
        $new_page = $request->store();

        return redirect()->route('pages.edit', ['id' => $new_page->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $this->authorize('view', $page);

        return view('content-management.pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $this->authorize('update', $page);

        return view('content-management.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesPage $request, Page $page)
    {
        $this->authorize('update', $page);

        $request->update($page);

        return redirect()->route('pages.edit', ['id' => $page->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);
         
        $page->delete();

        return redirect()->route('pages.index');
    }

    /* Methods for grabbing public page */
    // Can use this if we want each page to use the same template.
    public function showPage($url_path = null)
    {
        $page = Page::where('path', '/' . $url_path)->where('active', 1)->first();

        if( is_null($page) )
            return view('content.page_not_found');

        return view('content.regular_page')->with('page', $page);
    }

    public function showPagePreview($url_path = null)
    {
        $page = Page::where('path', '/' . $url_path)->firstOrFail();

        return view('content.regular_page')->with('page', $page);
    }
}

