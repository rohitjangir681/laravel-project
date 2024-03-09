<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\OrderAddress;
use App\Models\OrderItem;

class ManageCustomerController extends Controller
{
    public function index() {
        abort_unless(Gate::allows('manage_customers'), 403);
        $customers = User::where('is_admin', 0)->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function show($id) {
        // echo $id;

        $customer = User::where('is_admin', 0)->where('id', $id)->first();

        $orders = Order::where('user_id',$id)->get();
        return view('admin.customer.show', compact('orders', 'customer'));
    }

    public function orderShow($id) {
        // echo $id;
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('admin.orders.show', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
    }


}
