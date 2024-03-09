@extends('layouts.web')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <span class="breadcrumb-item active">Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    {{-- {{ ₹uotes->quoteItems }} --}}

    <!-- Cart Start -->
    <div class="container-fluid">
        @if (cartSummaryCount())
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">

                            @foreach ($quotes->quoteItems as $quote)
                                {{-- <h1>{{ $quotes }}</h1> --}}

                                <tr>

                                    
                                    <td class="align-middle"><img src="{{ productImage($quote->product_id) }}"
                                            alt="" style="width: 50px;">{{ $quote->name }}

                                        <br> <span>
                                            {{-- @php
                                                $customOption = json_decode($quote->custom_option);
                                                $color = $customOption->Colors;
                                                $size = $customOption->Sizes ?? 'No Size';
                                            @endphp
                                            @if ($color || $size)
                                                Color: {{ $color }} <br>
                                                Size: {{ $size }}
                                            @endif --}}

                                            @if ($quote->custom_option)
                                            @php
                                                $customOptions = json_decode($quote->custom_option, true);
                                            @endphp

                                            @foreach ($customOptions as $attrName => $attrValue)
                                                <strong>{{ $attrName }}:</strong>
                                                {{ $attrValue }} <br>
                                            @endforeach
                                        @endif

                                        </span>

                                    </td>
                                    <td class="align-middle">₹{{ $quote->price }}</td>
                                    {{-- <h1>{{ $quote->id }}</h1> --}}
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">

                                            <form action="{{ route('cart.update-item', $quote->id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="qty" style="width: 65%;" value="{{ $quote->qty }}" step="1" class="c-input-text qty text qty-box">
                                                <div class="update-qty" style="display: none">
                                                    <input type="submit" class="btn btn-dark w-200" value="✓">

                                                </div>  
                                            </form>

                                        </div>
                                    </td>
                                    <td class="align-middle">₹ {{ $quote->row_total }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.delete', $quote->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <h1>{{ $quote->product_id }}</h1> --}}

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    @if (session()->has('error'))
                        <div style="color: red;" class="callout callout-danger" style="margin-top: 20px;">
                            {{ session()->get('error') }}
                        </div>
                    @elseif(session()->has('success'))
                        <div style="color: green;" class="callout callout-success" style="margin-top: 20px;">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form class="mb-30" action="{{ route('coupon.apply') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="hidden" value="{{ $quotes->id }}" name="quotes_id">
                            <input type="text" name="coupon" class="form-control border-0 p-4"
                                value="{{ $quotes->coupon }}" placeholder="Coupon Code">
                            <div class="input-group-append">
                                @if (!$quotes->coupon)
                                    <button type="submit" name="action" value="apply_coupon" class="btn btn-primary">Apply
                                        Coupon</button>
                                @else
                                    <button type="submit" name="action" value="cancel"
                                        class="btn btn-primary">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>₹ {{ $quotes->subtotal }}</h6>
                            </div>


                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Discount</h6>
                                <h6 class="font-weight-medium">₹ {{ $quotes->coupon_discount ?? 0 }}</h6>
                            </div>
                            <br>
                            {{-- <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">₹10</h6>
                            </div> --}}
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>₹ {{ $quotes->total }}</h5>
                            </div>
                            <a href="{{ route('checkout.page') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                                Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid">
                <div class="row px-xl-5">
                    <h3 style="background: #FFD333;padding:20px;float:left;display:block;width:100%;">Your Cart is empty.
                    </h3>
                </div>
            </div>
        @endif
    </div>
    <!-- Cart End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- 
    <script>
        $(document).ready(function(){
            $('.cartItemForm').on('change', function(){
                var cartItem = $(this).
                $(cartItem).next('.update-qty').css('display', 'block');
            });
        });



</script> --}}


<script>
    $(document).ready(function() {
        $('.qty-box').on('change', function() {
            var form = $(this).closest('form');
            form.find('.update-qty').css('display', 'block');
        });
    });
</script>


@endsection
