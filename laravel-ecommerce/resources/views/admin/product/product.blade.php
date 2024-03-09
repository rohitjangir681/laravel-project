{{-- {{ $product }} --}}
@extends('layouts.web')


@section('content')
    {{-- <h1>Test product</h1> --}}


    {{-- @php
    
    $a = $product->related_product;

    $test = explode(', ', $a);

    foreach($test as $tt) {
        // echo $tt;
        echo $product->id;
    }
  

@endphp --}}

    {{-- <img src="{{ $product->getFirstMediaUrl('image') }}" alt=""> --}}

    {{-- <h1>Test</h1> --}}

    {{-- {{ $product->getMedia('banner_image') }} --}}

    {{-- @foreach ($product->getFirstMediaUrl('image') as $images)
    {{ $images }}
@endforeach --}}




    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">{{ $product->name }} Detail</span>
                </nav>
                @if (session()->has('success'))
                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                    {{ session()->get('success') }}</p>
            @endif
            </div>
        </div>
        
    </div>
    <!-- Breadcrumb End -->

    {{-- {{ $product }} --}}


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($product->getMedia('banner_image') as $image)
                            <div class="carousel-item {{ $i ? 'active' : '' }}" {{ $i = 0 }}>
                                <img class="w-100 h-100" src="{{ $image->getUrl() }}" alt="Image">
                            </div>
                        @endforeach


                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>

                    {{ getProductSpecialPrice($product->id) }}


                    <p class="mb-4" style="display:inline-block;">{{ $product->short_description }}</p>
                    <div class="d-flex mb-3">


                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                            @csrf




                            @foreach ($attributes as $key => $attribute)
                                <br><strong class="text-dark mr-3">{{ $key }} : </strong>
                                @foreach ($attribute as $attributeValue)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="{{ $attributeValue->name }}"
                                            name="attribute_value[{{ $key }}]">
                                        {{ $attributeValue->name }}
                                    </div>
                                @endforeach
                            @endforeach


                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity" style="width: 130px;">
                                    <input type="number" value="1" min="1" max="20" class="form-control"
                                        name="cart_item" style="margin-right: 10px;">
                                </div>
                                <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                                    Add To
                                    Cart</button>
                            </div>


                        </form>

                        <form action="{{ route('wishlist.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id ?? '' }}" name="user_id">
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <button type="submit" class="btn btn-outline-dark btn-square"><i
                                class="far fa-heart"></i></button>
                    </form>

                    </div>


                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="{{ asset('img/user.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1"
                                            style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum
                                                et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">

        {{-- {{ $product->related_product }} --}}

        {{-- {{ getRelatedProduct($product->related_product) }} --}}

        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">

                <div class="owl-carousel related-carousel">

                    @foreach (getRelatedProduct($product->related_product) as $_relatedProduct)
                        {{-- <h1>{{ $_relatedProduct->count() }}</h1> --}}
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100"
                                    src="{{ $_relatedProduct->getFirstMediaUrl('banner_image') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="{{ $_relatedProduct->url_key }}">{{ $_relatedProduct->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if ($_relatedProduct->special_price)
                                        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
                                            {{ $_relatedProduct->special_price }}</h3>
                                        <h4 class="font-weight-semi-bold mb-4"><del>{{ $_relatedProduct->price }}</del>
                                        </h4>
                                    @else
                                        <h4 class="font-weight-semi-bold mb-4">{{ $_relatedProduct->price }}</h4>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>




            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
