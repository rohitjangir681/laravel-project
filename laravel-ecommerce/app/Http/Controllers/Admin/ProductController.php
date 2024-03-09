<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('product_index'), 403);
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('product_create'), 403);
        $categories = Category::all();
        $products = Product::all();

        return view('admin.product.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // $test = $request->input('attributes');

        // $attributesId = $request->input('attributes');
        // $attributeValuesId = $request->input('attribute_values');
        // echo "<pre>";
        // print_r($attributeValuesId);
        // die;


        // echo "<pre>";
        // // print_r($test);

        // foreach($test as $image) {
        //     echo $image;
        // }

        // die;




        // die();


        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'sku' => 'required|unique:products',
            'qty' => 'required',
            'stock_status' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'short_description' => 'required|min:3|max:1000',
            'description' => 'required'
        ]);


        $data = $request->except('_token');

        $urlKeyData = $request->url_key ? $request->url_key : $request->name;

        $data['url_key'] = generateProductUniqueUrlKey($urlKeyData);
        // dd($data);

        // $relatedProduct = $request->input('related_product');
        $data['related_product'] = implode(', ', $data['related_product'] ?? []);




        $product = Product::create($data);

        $productId = $product->id;


        $attributesId = $request->input('attributes');
        $attributeValuesId = $request->input('attribute_values');

        if($attributesId) {
        foreach ($attributesId as $attributeId) {

            foreach ($attributeValuesId[$attributeId] as $attributeValueId) {
                // echo "<pre>";
                // echo $attributeValueId;
                ProductAttribute::create([
                    'product_id' => $productId,
                    'attribute_id' => $attributeId,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }
    }



        // dd($product->id);

        // -----------------

        if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }


        if ($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('banner_image');
            }
        }



        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        if ($request->get('action') == 'save') {
            return redirect()->route('product.index')->with('success', 'Product add successfully.');
        } else {
            return redirect()->back()->with('success', 'Product add successfully.');
        }

        // -----------------------

        // echo "<pre>";
        // print_r($request->input());

        // Product::create();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // echo $id;
        abort_unless(Gate::allows('product_show'), 403);
        $product = Product::where('id', $id)->first();
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // echo $id;
        abort_unless(Gate::allows('product_edit'), 403);
        $product = Product::find($id);
        $categories = Category::all();
        $relatedProducts = Product::all();
        $productAttributes = ProductAttribute::all();




        return view('admin.product.edit', compact('product', 'categories', 'relatedProducts', 'productAttributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // echo $id;

        // dd($request->all());


        // dd()

        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'sku' => 'required|unique:products,id,:id',
            'qty' => 'required',
            'stock_status' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        // $data = $request->except('_token', '_method');


        // $product = Product::where('id', $id)->update($data);
        $data = $request->all();
        $data['related_product'] = implode(', ', $data['related_product'] ?? []);
        $product = Product::findOrFail($id);

        $product->update($data);

        ProductAttribute::where('product_id', $product->id)->delete();

        $attributesId = $request->input('attributes');
        $attributeValuesId = $request->input('attribute_values');

        foreach ($attributesId as $attributeId) {

            foreach ($attributeValuesId[$attributeId] as $attributeValueId) {
                // echo "<pre>";
                // echo $attributeValueId;
                $data = [
                    'product_id' => $id,
                    'attribute_id' => $attributeId,
                    'attribute_value_id' => $attributeValueId
                ];
                ProductAttribute::create($data);
            }
        }


        // dd($product);


        if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
            $product->clearMediaCollection('thumbnail_image');
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }


        // if ($request->hasFile('thumbnail_image')) {
        //     $product->clearMediaCollection('thumbnail_image');
        //     $product->addMedia($request->file('thumbnail_image'))->toMediaCollection('thumbnail_image');
        // }


        if ($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('banner_image');
            }
        }



        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        // dd($request->all());

        return redirect()->route('product.index')->with('success', 'Product successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // echo $id;
        Product::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
