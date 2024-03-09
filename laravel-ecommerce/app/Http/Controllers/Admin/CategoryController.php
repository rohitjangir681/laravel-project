<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('category_index'), 403);
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('category_create'), 403);
        $categories = Category::select('id', 'name')->get();
        $products = Product::all();
        return view('admin.category.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ]);

        $data = $request->except('_token');

        $urlKeyData = $request->url_key ? $request->url_key : $request->name;

        $data['url_key'] = generateCategoryUniqueUrlKey($urlKeyData);

        $data['category_parent_id'] = $request->category_parent_id ? $request->category_parent_id : 0;

        // echo $data['category_parent_id'];

        $categories = Category::create($data);

        
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $categories->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->has('products')) {
            $categories->products()->sync($request->input('products'));
        }

        if ($request->get('action') == 'save') {
            return redirect()->route('category.index')->with('success', 'Category added successfully.');
        } else {
            return redirect()->back()->with('success', 'Category added successfully');
        }


        // dd($data);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // echo $id;
        abort_unless(Gate::allows('category_show'), 403);
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('category_edit'), 403);
        $categoryData = Category::find($id);
        $products = Product::all();
        return view('admin.category.edit', compact('categoryData', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ]);

        // dd($request->all());

        $data = $request->except('_token', '_method');
        $data['category_parent_id'] = $request->category_parent_id ? $request->category_parent_id : 0;

        $categories = Category::findOrFail($id);
        $categories->update($data);


        if($request->hasFile('image') && $request->file('image')->isValid()){
            $categories->clearMediaCollection('image');
            $categories->addMediaFromRequest('image')->toMediaCollection('image');
        }


        if($request->has('products')) {
            $categories->products()->sync($request->input('products'));
        }

        return redirect()->route('category.index')->with('success', 'Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // echo $id;
        Category::where('category_parent_id', $id)->delete();
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category has been deleted successfully.');
    }
}
