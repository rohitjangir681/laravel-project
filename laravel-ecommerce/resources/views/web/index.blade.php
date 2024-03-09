@extends('layouts.web')

@section('content')
    {{-- @php
    $test = getCategoriesForHomePage();
@endphp --}}

    {{-- {{ $test->count() }} --}}


    <!-- For front user login successfully message -->
    @if(session()->has('success'))
    <p style="background: #FFD333;
    padding: 15px;
    color: #000;
    font-weight: 500;">{{ session()->get('success') }}</p>
    @endif

    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($sliders as $slider)
                            <li data-target="#header-carousel" class="{{ $i == 0 ? 'active' : '' }}"
                                data-slide-to="{{ $i }}" {{ $i++ }}></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">


                        @php
                            $i = 1;
                        @endphp
                        @foreach ($sliders as $slider)
                            <div class="carousel-item position-relative {{ $i ? 'active' : '' }}" {{ $i = 0 }}
                                style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ $slider->getFirstMediaUrl('image') }}"
                                    style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                            {{ $slider->title }}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet
                                            lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
       @php
           $specialOfferBanner = getBlock('special-offer-banner');
       @endphp
       @if($specialOfferBanner)
            {!! $specialOfferBanner->description !!}
       @endif
        </div>
    </div>
    <!-- Carousel End -->

    {{-- {!! getBlock() !!} --}}

    {{-- @if (getBlock()->identifier === 'featured-start') --}}

    {{-- {{ getBlock()->title }} --}}

    {{-- @endif --}}


    <!-- Featured Start -->
    @php
        $featuredStart = getBlock('featured-start');
    @endphp
    @if ($featuredStart)
        {!! $featuredStart->description !!}
    @endif
    <!-- Featured End -->



    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            @foreach (getCategoriesForHomePage() as $_category)

            {{-- <h1>{{ $_category->products->count() }}</h1> --}}
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="{{ route('category.data', $_category->url_key) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid" src="{{ $_category->getFirstMediaUrl('image') }}" alt="">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $_category->name }}</h6>
                                <small class="text-body">{{ $_category->products->count() }} Products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured
                Products</span></h2>
        <div class="row px-xl-5">

            @foreach (IsFeatured() as $_product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $_product->getFirstMediaUrl('banner_image') }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.data', $_product->url_key) }}"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <form action="{{ route('wishlist.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->id ?? '' }}" name="user_id">
                                    <input type="hidden" value="{{ $_product->id }}" name="product_id">
                                    <button type="submit" class="btn btn-outline-dark btn-square"><i
                                            class="far fa-heart"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="{{ route('product.data', $_product->url_key) }}">{{ $_product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                @if ($_product->special_price)
                                    <h5>{{ $_product->special_price }}</h5>
                                    <h6 class="text-muted ml-2"><del>{{ $_product->price }}</del></h6>
                                @else
                                    <h5>{{ $_product->price }}</h5>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->

    @php
        $specialOffer = getBlock('special-offer');
    @endphp

    @if ($specialOffer)
        {!! $specialOffer->description !!}
    @endif
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent
                Products</span></h2>
        <div class="row px-xl-5">


            @foreach (recentProducts() as $recentProduct)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $recentProduct->getFirstMediaUrl('banner_image') }}" alt="">
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
                                href="{{ route('product.data', $recentProduct->url_key) }}">{{ $recentProduct->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                @if ($recentProduct->special_price)
                                    <h5>{{ $recentProduct->special_price }}</h5>
                                    <h6 class="text-muted ml-2"><del>{{ $recentProduct->price }}</del></h6>
                                @else
                                    <h5>{{ $recentProduct->price }}</h5>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Products End -->

    {{-- {{ $blocks }} --}}





    @php
        $vendorData = getBlock('companies-names');
    @endphp

    @if ($vendorData)
        {!! $vendorData->description !!}
    @endif
@endsection


{{-- 
    
    image and thumbnail_image

Selfie Sticks
Skin Stickers
Internal Batteries
Mounts & Stands
Lens Kits
Replacement Parts



    --}}
