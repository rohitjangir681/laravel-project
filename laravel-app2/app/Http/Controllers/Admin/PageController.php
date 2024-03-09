<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function index() {

        $pages = Page::all();

        return view('admin.page.index', compact('pages'));
    }

    public function create() {
        return view('admin.page.create');
    }

    public function store(Request $request) {

        
        // $data['parent_id'] = $request->parent_id;
        // dd($data['parent_id']);

        // echo $data['parent_id'];
        // die();

        // dd($data['description']);
        
        $data = $request->validate([
            'name' => 'required',
            'heading' => 'required',
            'url_key' => 'required|unique:pages',
        ]);
        $data['description'] = $request->description;
        $data['parent_id'] = $request->parent_id ? $request->parent_id : 0;
        $data['url_key'] = str_replace(' ', '-', $request->url_key);

        Page::create($data);
        return redirect()->route('page.index');

        // dd($request->all());
    }


    public function pageData(Request $request) {
        // dd($request->url_key);
         
        $urlKey = $request->url_key;

        $page = Page::where('url_key', $urlKey)->first();
        return view('admin.page.page', compact('page'));

    }

    public function customImage(Request $request) {
        return $request->file('image_name')->store('custom-toda-image');
        // dd($request->all());
    }

}
