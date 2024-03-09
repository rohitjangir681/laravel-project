<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Block;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class HomeController extends Controller
{
    public function index()
    {

        
        $sliders = Slider::where('status', 1)->orderBy('ordering', 'ASC')->get();


        return view('web.index', compact('sliders'));



        // return "test";
    }

    public function contact()
    {
        return view('web.contact');
    }

    // getting page and block data by this method
    public function pageData($url_key)
    {
        // echo $url_key;
        // $pageData = Page::where('url_key', $url_key)->first() ? Page::where('url_key', $url_key)->first() : Block::where('identifier', $url_key)->first();
        $pageData = Page::where('url_key', $url_key)->first();
        if ($pageData) {
            // return $pageData->url_key;
            return view('admin.page.page', compact('pageData'));
        } else {
            abort(403);
        }
    }


    // getting category data by this method
    public function categoryData(Request $request, $url_key)
    {
        // echo $url_key;
        $fullUrl = URL::full();
        // dd($request->change_number_product);   

        // dd(explode('-', $request->price));
        $category = Category::where('url_key', $url_key)->first();
        $query = $category->products();
        // $category = Category::with(['products' => function ($query) use ($request) {
        if ($request->has('price')) {
            $priceExp = explode('-', $request->price);
            $priceExp[0]= (int)$priceExp[0];
            $priceExp[1]= (int)$priceExp[1];
            //  dd($priceExp);
            $query->whereBetween('products.price', $priceExp);
        }

        if ($request->has('sorting') && $request->sorting == 'latest') {
            $query->orderBy('id', 'desc');
        } elseif ($request->has('sorting') && $request->sorting == 'low_to_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->has('sorting') && $request->sorting == 'high_to_low') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->paginate(9);
        // }])->where('url_key', $url_key)->first();

        // echo "<pre>";
        // print_r($category->products);
        // die;
        // //$products = $category->products()->paginate(9);

        if ($category) {
            return view('admin.category.category', compact('category', 'products', 'request', 'fullUrl'));
        } else {
            abort(403);
        }
    }

    // getting product data by this method
    public function productData($url_key)
    {
        // echo $url_key;

        $product = Product::where('url_key', $url_key)->first();
        $productAttributes = ProductAttribute::where('product_id', $product->id)->get();
        $attributes = [];

        foreach ($productAttributes as $productAttribute) {
            $attributeId = $productAttribute->attribute_id;
            $attributeValueId = $productAttribute->attribute_value_id;
            $attribute = Attribute::find($attributeId);
            $attributeValue = AttributeValue::find($attributeValueId);

            if ($attribute && $attributeValue) {
                if (!isset($attributes[$attribute->name])) {
                    $attributes[$attribute->name] = [];
                }
                $attributes[$attribute->name][] = $attributeValue;
            }
        }

        if ($product) {
            return view('admin.product.product', compact('product', 'attributes'));
        } else {
            abort(403);
        }
    }
}
