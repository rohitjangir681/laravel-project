@extends('layouts.admin')

@section('content')

<section class="content-header">
    <h1>
        Manage Orders
    </h1>
</section>

{{-- {{ $orders }} --}}

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Enquiry Page</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <style>
                        #myTable_wrapper{
                            overflow: auto;
                        }   
                    </style>
                  <table id="myTable" class="table table-bordered display">
                    <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Order Id</th>
                      <th>User Id</th>
                      <th>Address</th>
                      <th>Address_2</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Country</th>
                      <th>Pincode</th>
                      <th>Subtotal</th>
                      <th>Coupon</th>
                      <th>Coupon Discount</th>
                      <th>Shipping Cost</th>
                      <th>Total</th>
                      <th>Payment Method</th>
                      <th>Shipping Method</th>
                      <th>Show</th>
                    </tr>
                  </thead>
                  @php
                    $i=1;   
                  @endphp
                  <tbody>
                    @forelse($orders as $_order)
                    <tr>
                        <td>{{ $i++ . '.' }}</td>
                        <td>{{ $_order->name }}</td>
                        <td>{{ $_order->email }}</td>
                        <td>{{ $_order->phone }}</td>
                        <td>{{ $_order->order_increment_id }}</td>
                        <td>{{ $_order->user_id }}</td>
                        <td>{{ $_order->address }}</td>
                        <td>{{ $_order->address_2 }}</td>
                        <td>{{ $_order->city }}</td>
                        <td>{{ $_order->state }}</td>
                        <td>{{ $_order->country }}</td>
                        <td>{{ $_order->pincode }}</td>
                        <td>{{ $_order->subtotal }}</td>
                        <td>{{ $_order->coupon }}</td>
                        <td>{{ $_order->coupon_discount }}</td>
                        <td>{{ $_order->shipping_cost }}</td>
                        <td>{{ $_order->total }}</td>
                        <td>{{ $_order->payment_method }}</td>
                        <td>{{ $_order->shipping_method }}</td>
                        <td><a href="{{ route('order.show', $_order->id) }}" class="btn btn-primary">Show</a></td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="20" align="center">No order</td>
                      </tr>
                      @endforelse
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              
              </div><!-- /.box -->
        </div>
    </div>



</section>

@endsection
