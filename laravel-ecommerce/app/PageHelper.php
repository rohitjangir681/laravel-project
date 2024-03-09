<?php

use App\Models\Page;
use App\Models\Block;
use App\Models\Category;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuotesItem;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


function getPages()
{

    $pages = Page::where('status', 1)->orderBy('ordering', 'ASC')->get();
    return $pages;
}

function getBlocks()
{
    $blocks = Block::where('status', 1)->orderBy('ordering', 'ASC')->get();
    return $blocks;
}


// Get Category
function getCategories()
{
    $categories = Category::where('category_parent_id', 0)->where('show_in_menu', 1)->get();
    return $categories;
}

function subCategories($id)
{
    $categories = Category::where('category_parent_id', $id)->get();
    return $categories;
}

function subSubCategories($id)
{
    $categories = Category::where('category_parent_id', $id)->get();
    return $categories;
}

function getCategoryName($category_parent_id)
{
    $categoryName = Category::where('id', $category_parent_id)->first();
    return $categoryName->name ?? 'No Parent Category.';
}


// get Category for home page
function getCategoryHomePage()
{
    $categories = Category::where('category_parent_id', 0)->where('status', 1)->where('show_in_menu', 1)->get();
    return $categories;
}


// get Sub Category for home page
function getSubCategoryHomePage($id)
{
    $categories = Category::where('category_parent_id', $id)->get();
    return $categories;
}

// getting Is Featured products
function IsFeatured()
{
    $products = Product::where('is_featured', 1)->limit(8)->orderBy('id', 'ASC')->get();
    return $products;
}

// getting recent products
function recentProducts()
{
    $recent_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
    return $recent_products;
}

// getting categories for Home page with limit
function getCategoriesForHomePage()
{
    $categories = Category::where('status', 1)->orderBy('id', 'DESC')->limit(12)->get();
    return $categories;
}


// getting related product 
function getRelatedProduct($ids)
{
    $ids = explode(', ', $ids);
    // dd($ids);
    $relatedProduct = Product::whereIn('id', $ids)->get();
    // dd($relatedProduct);
    return $relatedProduct;
}


// getting Attributes

function getAttribute()
{
    $attributes = Attribute::all();
    return $attributes;
}



// getProductPrice helper
function getProductPrice($pId)
{

    $todayDate = Carbon\Carbon::now();

    $product = Product::find($pId);

    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
    // echo $mytime->toDateTimeString();
}

function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return ($quote->quoteItems ?? 0) ? $quote->quoteItems->count() : 0;
    } else {
        return 0;
    }
}

// recalculateCart helper

function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();
    $quotesItems = $quote->quoteItems;

    foreach ($quotesItems as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
        // echo $item;
    }


    $quote->subtotal = $quote->quoteItems->sum('row_total');
    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon = NULL;
        $quote->coupon_discount = 0;
        // return redirect()->back()->with('error', 'Coupon not applicable.');
    }


    $quote->user_id = Auth::user()->id ?? null;

    $quote->save();


    //return $quote->quoteItems->count();

}

// get product image for view cart page

function productImage($pId)
{
    $product = Product::find($pId);
    return $product->getFirstMediaUrl('thumbnail_image');
}


// getiing special price for product
function getProductSpecialPrice($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate)) {
        // return $product->special_price;
?>

        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
            ₹<?= $product->special_price ?></h3>
        <h4 class="font-weight-semi-bold mb-4"><del>₹<?= $product->price ?></del></h4>
    <?php

    } else {
        // return $product->price;
    ?>
        <h4 class="font-weight-semi-bold mb-4">₹<?= $product->price ?></h4>
<?php
    }
    return;
}


// getting product price for checkout page and other page
function getProductPriceForCheckoutAndOther($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
    return;
}



function getAuthUserId()
{
    // echo "Auth user id";
    if (Auth::user()) {
        return Auth::user()->id;
    } else {
        return 0;
    }
}


function cartWishlistCount()
{
    // echo $id;

    if (Auth::user()) {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
        if ($wishlist) {
            return $wishlist;
        }
    }
    return 0;

    // dd($wishlist);


}




function reActiveCart($userId) {
    $cartId = Session::get('cart_id');
 

    if($cartId) {
        Quote::where('cart_id', $cartId)->update([
            'user_id' => $userId
        ]);
    }

    if($cartId) {
        $quoteOld = Quote::where('user_id', $userId)->where('cart_id', '!=', $cartId)->first();
        
        if($quoteOld) {
            $newQuote = Quote::where('cart_id', $cartId)->first();
            // dd($newQuote);
            $quoteId = $newQuote->id??0;
            QuotesItem::where('quote_id', $quoteOld->id)->update(['quote_id' => $quoteId]);
            $quoteOld->delete();
        } 

    } else {
        $quote = Quote::where('user_id', $userId)->first();
        // dd($quote);
        if ($quote) {
            $cartId = $quote->cart_id;
            Session::put('cart_id', $cartId);
        }
    }


}



function getProductPriceFilter($categoryId) {
    $category = Category::with('products')->where('id', $categoryId)->first();
    $minPrice = $category->products->min('price');
    $maxPrice = $category->products->max('price');
    $interval = 1000;

    $ranges = generatePriceRanges($category->products, $minPrice, $maxPrice, $interval);
    return $ranges;
}

function generatePriceRanges($products, $minPrice, $maxPrice, $interval) {
    $ranges = [];
    $numIntervals = ceil(($maxPrice - $minPrice + 1) / $interval);
    for ($i = 0; $i < $numIntervals; $i++) {
        $startPrice = $minPrice + ($i * $interval);
        $endPrice = min($startPrice + $interval - 1, $maxPrice);
        $productCount = $products->where('price', '>=', $startPrice)
                                ->where('price', '<=', $endPrice)
                                ->count();
        // $ranges[] = "$startPrice-$endPrice";
        $ranges[] = [
            'start' => $startPrice,
            'end' => $endPrice,
            'count' => $productCount,
        ];

    }
    return $ranges;
}





