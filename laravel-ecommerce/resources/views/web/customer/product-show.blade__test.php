@extends('layouts.web')

@section('content')
    {{-- <h1>Auth Id: {{ getAuthUserId() }} </h1> --}}


    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30" style="float: left;width:100%;">
                    <div style="float: left;width:100%;">
                    <a href="{{ route('customer.profile') }}" class="btn btn-primary" style="float: right;">Back</a>
                </div>
                    {{-- <div class="nav nav-tabs mb-4" style="float: left;width:30%;">
                        <style>
                            .nav.nav-tabs.mb-4 a {
                                float: left;
                                width: 100%;
                            }

                            .nav-tabs .nav-link.active {
                                background-color: #FFD333;
                            }
                        </style>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-1">PROFILE DETAILS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">WISHLIST</a>
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">ORDERS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">ADDRESS</a>
                    </div> --}}

                    <div class="tab-content">
                        
                        




                    {{-- <div class="tab-pane fade show" id="tab-pane-1">
                        <h4 class="mb-3">Product Description 1</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                            invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                            consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam.
                            Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos
                            dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                            nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                            tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor
                            consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita
                            clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum.
                            Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                    </div> --}}

                    {{-- <div class="tab-pane fade show" id="tab-pane-2">
                        <h4 class="mb-3">Product Description 2</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                            invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                            consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam.
                            Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos
                            dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                            nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                            tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor
                            consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita
                            clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum.
                            Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                    </div> --}}

                    <div class="tab-pane fade show active" id="tab-pane-3">


                        {{-- <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Row Total</th>
                                    <th>Custom Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $_orderItem)
                                <tr>
                                <td>{{ $_orderItem->name }}</td>
                                <td>{{ $_orderItem->sku }}</td>
                                <td>{{ $_orderItem->price }}</td>
                                <td>{{ $_orderItem->qty }}</td>
                                <td>{{ $_orderItem->row_total }}</td>
                                <td>{{ $_orderItem->custom_option }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}


                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 style="font-weight:500;">Order Information</h5>
                                            <hr style="margin: 0; border-width:2px;">
                                            <p><strong> Order ID :</strong> {{ $order->order_increment_id }}</p>
                                            <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 style="font-weight:500;">Account Information</h5>
                                            <hr style="margin: 0; border-width:2px;">
                                            <p><strong>Customer name:</strong> {{ $order->name }}</p>
                                            <p><strong>Email:</strong> {{ $order->email }}</p>
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
                                                    <p><strong>City:</strong> {{ $billingAddress->city ?? '' }}</p>
                                                    <p><strong>State:</strong> {{ $billingAddress->state ?? '' }}</p>
                                                    <p><strong>Country:</strong> {{ $billingAddress->country ?? '' }}</p>
                                                    <p><strong>PIN Code:</strong> {{ $billingAddress->pincode ?? '' }}</p>
                                                    <p><strong>Address:</strong> {{ $billingAddress->address ?? ''}}</p>
                                                    <p><strong>Address 2:</strong> {{ $billingAddress->address_2 ?? ''}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 style="font-weight:400;">Shipping Address</h5>
                                                    <p><strong>City:</strong> {{ $shippingAddress->city ?? ''}}</p>
                                                    <p><strong>State:</strong> {{ $shippingAddress->state ?? ''}}</p>
                                                    <p><strong>Country:</strong> {{ $shippingAddress->country ?? ''}}</p>
                                                    <p><strong>PIN Code:</strong> {{ $shippingAddress->pincode ?? ''}}</p>
                                                    <p><strong>Address:</strong> {{ $shippingAddress->address ?? ''}}</p>
                                                    <p><strong>Address 2:</strong> {{ $shippingAddress->address_2 ?? ''}}</p>
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
                                                    <p><strong>Payment Method:</strong>  {{ $order->payment_method }}</p>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 style="font-weight:400;">Shipping Information</h5>
                                                    <p><strong>Shipping Method:</strong>  {{ $order->shipping_method }}</p>
                                                   
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
                                                @foreach($orderItems as $_orderItem)
                                                <tr>
                                                    <td>{{ $_orderItem->name }}</td>
                                                    <td>{{ $_orderItem->sku }}</td>
                                                    <td>{{ $_orderItem->price }}</td>
                                                    <td>{{ $_orderItem->qty }}</td>
                                                    <td>{{ $_orderItem->row_total }}</td>
                                                    <td>{{ $_orderItem->custom_option }}</td>
                                                </tr>
                                                @endforeach
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
                                                        <th>{{ $order->coupon }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Coupon Discount:</th>
                                                        <th>{{ $order->coupon_discount }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping Cost:</th>
                                                        <th>{{ $order->shipping_cost }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>SubTotal:</th>
                                                        <th>{{ $order->subtotal }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <th>{{ $order->total }}</th>
                                                    </tr>
                                                </table>
                                               
                                            </div>
                                        </div>
                                    </div>
            
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>






                    
                    </div>

                    <div class="tab-pane fade show" id="tab-pane-4">
                        <h4 class="mb-3">Product Description 4</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                            invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                            consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam.
                            Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos
                            dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                            nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                            tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor
                            consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita
                            clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum.
                            Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                    </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
