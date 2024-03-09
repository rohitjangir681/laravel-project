@extends('layouts.web')

@section('content')
    {{-- <h1>Auth Id: {{ getAuthUserId() }} </h1> --}}

    {{-- <h1>Test Heading</h1> --}}

    {{-- {{ $wishlist->wishlistProduct }} --}}

    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30" style="float: left;width:100%;">
                    <div class="nav nav-tabs mb-4" style="float: left;width:30%;">
                        <style>
                            .nav.nav-tabs.mb-4 a {
                                float: left;
                                width: 100%;
                            }

                            .nav-tabs .nav-link.active {
                                background-color: #FFD333;
                            }
                        </style>
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">PROFILE DETAILS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">WISHLIST</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">ORDERS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">ADDRESS</a>
                    </div>
                    <div class="tab-content" style="float: left;width:70%;padding-right:15px;padding-left:15px;">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            @if (session()->has('error'))
                                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                    {{ session()->get('error') }}</p>
                            @endif
                            @if (session()->has('success'))
                                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                    {{ session()->get('success') }}</p>
                            @endif
                            <form action="{{ route('customer.update') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="{{ Auth::user()->name }}"
                                            type="text" placeholder="Enter name">
                                        @error('name')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" name="email" value="{{ Auth::user()->email }}"
                                            type="text" placeholder="Enter email">
                                        @error('email')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" name="current_password" value="" type="text"
                                            placeholder="Enter current password">
                                        @error('current_password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="password" value="" type="text"
                                            placeholder="Enter password">
                                        @error('password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="form-control btn btn-primary" style="width: 50%;">Save
                                            Change</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show" id="tab-pane-2">
                            
                                @forelse ($wishlist as $_wishlist)
                                {{-- <h1>{{ $_wishlist->product_id }}</h1> --}}
                                    <div style="width:100%;float:left;border:1px solid rgba(0, 0, 0, 0.1);margin-top:1rem;margin-bottom:1rem;">
                                        <a href="{{ route('product.data', $_wishlist->wishlistProduct->url_key) }}">
                                        <div style="width: 20%;padding:20px;float:left;">
                                            <img src="{{ $_wishlist->wishlistProduct->getFirstMediaUrl('banner_image') }}"
                                                alt="" style="width: 100%;">
                                        </div>
                                        <div style="padding:20px;float:left;width:70%;">
                                            <p>
                                            {{ $_wishlist->wishlistProduct->name }}
                                        </p>
                                        <p>
                                            {{ getProductSpecialPrice($_wishlist->wishlistProduct->id) }}
                                        </p>
                                        </div>
                            
                                    </a>
                                    <div style="padding:20px;float:left;width:10%;">
                                        <form action="{{ route('wishlist.destroy', $_wishlist->wishlistProduct->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                        
                                    </div>

                                    </div>
                                    @empty
                                    <h4>No Wishlist.</h4>

                                @endforelse

                        </div>
                        <div class="tab-pane fade show" id="tab-pane-3" style="overflow: auto;">
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
                                    $i = 1;
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
                                            <td>
                                                <button type="button" data-order-id="{{ $_order->id }}"
                                                    class="btn btn-primary detail_show">Show</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" align="center">No order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="tab-pane-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-3">Billing Address</h4>
                                    <p><strong>City:</strong>{{ $billingAddress->city ?? '' }}</p>
                                    <p><strong>State:</strong>{{ $billingAddress->state ?? '' }}</p>
                                    <p><strong>Country:</strong>{{ $billingAddress->country ?? '' }}</p>
                                    <p><strong>PIN Code:</strong>{{ $billingAddress->pincode ?? '' }}</p>
                                    <p><strong>Address:</strong> {{ $billingAddress->address ?? '' }}</p>
                                    <p><strong>Address 2:</strong> {{ $billingAddress->address_2 ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-3">Shipping Address</h4>
                                    <p><strong>City:</strong>{{ $shippingAddress->city ?? '' }}</p>
                                    <p><strong>State:</strong>{{ $shippingAddress->state ?? '' }}</p>
                                    <p><strong>Country:</strong>{{ $shippingAddress->country ?? '' }}</p>
                                    <p><strong>PIN Code:</strong>{{ $shippingAddress->pincode ?? '' }}</p>
                                    <p><strong>Address:</strong>{{ $shippingAddress->address ?? '' }}</p>
                                    <p><strong>Address 2:</strong>{{ $shippingAddress->address_2 ?? '' }}</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // $(".detail_show").click(function(){
            //     alert('test test');
            // });

            $(".detail_show").on('click', function(e) {
                e.preventDefault();
                var orderId = $(this).data('order-id');
                var url = "{{ route('customer.product.show', ':id') }}".replace(':id', orderId);

                // console.log(url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(result) {
                        // console.log(result);
                        $("#tab-pane-3").html(result);
                    },
                    error: function(er) {
                        alert(er);
                    }
                });


            });


        });
    </script>
@endsection
