@extends('layouts.admin')
@section('content')

{{-- {{ $data }} --}}

<a href="{{ route('delete') }}">Back</a>

@foreach($data as $_data)
<h4>{{ $_data->name }}</h4>
<br>
<h4>{{ $_data->email }}</h4>
<br>
<h4>{{ $_data->phone }}</h4>
@endforeach

@endsection