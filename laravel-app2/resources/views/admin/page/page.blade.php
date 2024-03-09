{{-- {{ $page }} --}}

@extends('layouts.home')

@section('content')

<h2>Name: {{ $page->name }}</h2>
<h2>Heading: {{ $page->heading }}</h2>
<p>
    {{ $page->description }}
</p>

@endsection
