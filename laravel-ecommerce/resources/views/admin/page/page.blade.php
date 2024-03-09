@extends('layouts.web')

@section('content')
    <style>
        img {
            width: 100%;
        }

        .image.image-style-side {
            width: 50%;
            float: right;
        }
    </style>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <span class="breadcrumb-item active">{{ $pageData->title }}</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">{{ $pageData->title }}</span></h2>
    </div>

    {{-- banner image --}}
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <img class="w-100 h-100" src="{{ $pageData->getFirstMediaUrl('image') }}">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                {!! $pageData->description !!}
            </div>
        </div>
    </div>


    {{-- {{ $pageData }} --}}
@endsection
