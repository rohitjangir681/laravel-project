<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_unless(Gate::allows('page_index'), 403);

        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('page_create'), 403);
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->except('_token');


        $title = $request->title;
        $urlKey = $request->url_key;
        $urlKey = $urlKey ? $urlKey : $title;

        $urlKeyLower = Str::lower($urlKey);
        $url_Key = Str::replace(' ', '-', $urlKeyLower);

        $pageData = Page::create([
            'title' => $title,
            'heading' => $request->heading,
            'description' => $request->description,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'url_key' => $url_Key
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $pageData->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('page.index')->withSuccess('Page Add Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        abort_unless(Gate::allows('page_edit'), 403);

        $data = Page::find($id);
        return view('admin.page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $pageData = Page::findOrFail($id);
        $pageData->update($data);

        if ($request->hasFile('image')) {
            $pageData->clearMediaCollection('image');
            $pageData->addMedia($request->file('image'))->toMediaCollection('image');
        }

        // dd($request->all());
        return redirect()->route('page.index')->withSuccess('Page Update Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('id', $id)->delete();
        return redirect()->route('page.index')->withSuccess('Page DELETE Successfully.');
    }

    public function upload(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('media'), $fileName);
      
            $url = asset('media/' . $fileName);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
