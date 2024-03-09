<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function create()
    {
        return view('web.customer.create');
    }

    public function customerLogin()
    {

        return view('web.customer.login');
    }




    // User create

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => 0,
            'password' => Hash::make($request->password)
        ]);


        return redirect()->back()->with('success', 'User created successfully.');
    }




    //  User login
    public function login(Request $request)
    {
        // Session::get('cart_id');
        // dd($request->all());



        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0])) {
            // echo "user login successfully.";
            reActiveCart(getAuthUserId());

            return redirect()->route('home')->with('success', 'User login successfully.');
        } else {
            // echo "Your login detail is wrong";
            return redirect()->back()->with('error', 'Your login details do not match in our records.');
        }
    }

    public function logout()
    {
        Session::forget('cart_id');

        Auth::logout();
        return redirect()->route('customer.login')->with('success', 'You are successfully logged out');
    }



    public function profile()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->get();
        $billingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'shipping')->first();
        $wishlist = Wishlist::with('wishlistProduct')->where('user_id', $userId)->get();
        // dd($wishlist);
        return view('web.customer.profile', compact('orders', 'billingAddress', 'shippingAddress', 'wishlist'));
    }



    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required'
        ]);

        $auth = Auth::user();

        if (!Hash::check($request->current_password, $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }

        if (strcmp($request->current_password, $request->password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', "User details have been changed Successfully");
    }



    public function customerProductShow($id)
    {
        // echo $id;


        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        // return view('web.customer.product-show', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));

?>




        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 style="font-weight:500;">Order Information</h5>
                                <hr style="margin: 0; border-width:2px;">
                                <p><strong> Order ID :</strong> <?= $order->order_increment_id ?></p>
                                <p><strong>Order Date:</strong> <?= $order->created_at ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5 style="font-weight:500;">Account Information</h5>
                                <hr style="margin: 0; border-width:2px;">
                                <p><strong>Customer name:</strong> <?= $order->name ?></p>
                                <p><strong>Email:</strong> <?= $order->email ?></p>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">


                                <h5 style="font-weight:500;">Address Information</h5>
                                <hr style="margin: 0; border-width:2px;">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:400;">Billing Address</h5>
                                        <p><strong>City:</strong> <?= $billingAddress->city ?? '' ?></p>
                                        <p><strong>State:</strong> <?= $billingAddress->state ?? '' ?></p>
                                        <p><strong>Country:</strong> <?= $billingAddress->country ?? '' ?></p>
                                        <p><strong>PIN Code:</strong> <?= $billingAddress->pincode ?? '' ?></p>
                                        <p><strong>Address:</strong> <?= $billingAddress->address ?? '' ?></p>
                                        <p><strong>Address 2:</strong> <?= $billingAddress->address_2 ?? '' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 style="font-weight:400;">Shipping Address</h5>
                                        <p><strong>City:</strong> <?= $shippingAddress->city ?? '' ?></p>
                                        <p><strong>State:</strong> <?= $shippingAddress->state ?? '' ?></p>
                                        <p><strong>Country:</strong> <?= $shippingAddress->country ?? '' ?></p>
                                        <p><strong>PIN Code:</strong> <?= $shippingAddress->pincode ?? '' ?></p>
                                        <p><strong>Address:</strong> <?= $shippingAddress->address ?? '' ?></p>
                                        <p><strong>Address 2:</strong> <?= $shippingAddress->address_2 ?? '' ?></p>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-md-12">


                                <h5 style="font-weight:500;">Payment & Shipping Method</h5>
                                <hr style="margin: 0; border-width:2px;">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:400;">Payment Information</h5>
                                        <p><strong>Payment Method:</strong> <?= $order->payment_method ?></p>

                                    </div>
                                    <div class="col-md-6">
                                        <h5 style="font-weight:400;">Shipping Information</h5>
                                        <p><strong>Shipping Method:</strong> <?= $order->shipping_method ?></p>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-md-12">


                                <h5 style="font-weight:500;">Item Ordered</h5>
                                <hr style="margin: 0; border-width:2px;">

                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Row Total</th>
                                        <th>Custom Option</th>
                                    </tr>
                                    <?php
                                    foreach ($orderItems as $_orderItem) {
                                    ?>
                                        <tr>
                                            <td><?= $_orderItem->name ?></td>
                                            <td><?= $_orderItem->sku ?></td>
                                            <td><?= $_orderItem->price ?></td>
                                            <td><?= $_orderItem->qty ?></td>
                                            <td><?= $_orderItem->row_total ?></td>
                                            <td><?= $_orderItem->custom_option ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>

                            </div>

                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-md-12">

                                <h5 style="font-weight:500;">Order Total</h5>
                                <hr style="margin: 0; border-width:2px;">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <h5 style="font-weight:400;">Account Information</h5>
                                    <hr style="margin: 0; border-width:2px;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Coupon:</th>
                                            <th><?= $order->coupon ?></th>
                                        </tr>
                                        <tr>
                                            <th>Coupon Discount:</th>
                                            <th><?= $order->coupon_discount ?></th>
                                        </tr>
                                        <tr>
                                            <th>Shipping Cost:</th>
                                            <th><?= $order->shipping_cost ?></th>
                                        </tr>
                                        <tr>
                                            <th>SubTotal:</th>
                                            <th><?= $order->subtotal ?></th>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <th><?= $order->total ?></th>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>



<?php

    }
}
