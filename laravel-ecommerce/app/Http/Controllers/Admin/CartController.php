<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Quote;
use App\Models\QuotesItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // echo $id;
        // dd($request->all());
        $attributeValue = json_encode(($request->attribute_value ?? []));

        $cartItem = $request->cart_item;
        $productId = $id;

        $productData = Product::find($id);
        $price = getProductPrice($id);

        // echo "<pre>";
        // print_r($test);

        // die;

        // echo $cart_id;
        $cart_id = Session::get('cart_id');

        if ($cart_id) {

            $quote = Quote::firstOrCreate(['cart_id' => $cart_id]);
            $quoteId = $quote->id;

            $quotesItem = QuotesItem::where('quote_id', $quoteId)->where('product_id', $productId)->first();

            if ($quotesItem) {
                QuotesItem::where('id', $quotesItem->id)->where('quote_id', $quoteId)->update([
                    'qty' => $cartItem + $quotesItem->qty
                ]);
            } else {
                // echo "New Data";
                QuotesItem::create([
                    'quote_id' => $quoteId,
                    'name' => $productData->name,
                    'sku' => $productData->sku,
                    'price' => $price,
                    'product_id' => $productId,
                    'custom_option' => $attributeValue,
                    'qty' => $cartItem,
                ]);
            }
        } else {


            // echo "this is else";
            // die;
            $cart_id = Str::uuid()->toString();
            Session::put('cart_id', $cart_id);

            $quoteData = Quote::create([
                'cart_id' => $cart_id,
                'user_id' => getAuthUserId(),
                'name' => Auth::user()->name ?? null,
                'email' => Auth::user()->email ?? null
            ]);

            

            $quote_id = $quoteData->id;

            QuotesItem::create([
                'quote_id' => $quote_id,
                'name' => $productData->name,
                'sku' => $productData->sku,
                'price' => $price,
                'product_id' => $productId,
                'custom_option' => $attributeValue,
                'qty' => $cartItem,
            ]);
        }

        recalculateCart();

        return redirect()->route('cart');
    }



    // View Cart method
    public function viewCart()
    {
        $cartId = Session::get('cart_id');
        $quotes = Quote::where('cart_id', $cartId)->first();


        return view('web.viewcart', compact('quotes'));
        // echo "this is cart page";
    }

    public function cartUpdate(Request $request, $id) {
        // dd($request->all());
        $quoteItem = QuotesItem::find($id);
        $qty = $request->qty;
        $rowTotal = $quoteItem->price * $qty;
        $data = [
            'qty' => $qty,
            'row_total' => $rowTotal,
        ];
        QuotesItem::where('id', $id)->update($data);
        recalculateCart();
        return redirect()->back();
        // echo "this is cart page";
        
    }


    // cart delete method
    public function cartDelete(Request $request, $id)
    {
        $quotesItem = QuotesItem::find($id);
        $quotesItem->delete();
        recalculateCart();
        return redirect()->back();
    }


    // apply coupon method
    public function couponApply(Request $request)
    {
        // echo "Coupon apply";
        // dd($request->all());


        // if($request->get('action') == 'save'
        $couponCode = $request->coupon;
        $quotesId = $request->quotes_id;
        if ($request->get('action') == 'apply_coupon') {

            $couponData = Coupon::where('coupon_code', $couponCode)->where('status', 1)->first();

            $cartId = Session::get('cart_id');
            $quote = Quote::where('cart_id', $cartId)->first();


            // dd($couponData);
            // $quote = Quote::where('id', $quotesId)->first();
            if ($couponData) {
                if (($couponData->valid_from <= now()) && ($couponData->valid_to >= now()) && ($couponData->discount_amount < $quote->subtotal)) {
                    Quote::where('id', $quotesId)->update([
                        'coupon' => $couponData->coupon_code,
                        'coupon_discount' => $couponData->discount_amount
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Coupon has been expired.');
                }


                recalculateCart();
                return redirect()->back()->with('success', 'Coupon Applied successfully.');
            } else {
                return redirect()->back()->with('error', 'Coupon not valid.');
            }

            // dd($couponData);
        } else {
            Quote::where('id', $quotesId)->update([
                'coupon' => NULL,
                'coupon_discount' => 0
            ]);
            recalculateCart();
            return redirect()->back()->with('success', 'Coupon deleted successfully.');
            // echo "test";
        }
    } // END couponApply function


  




}
