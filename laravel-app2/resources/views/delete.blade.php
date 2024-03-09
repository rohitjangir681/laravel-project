@extends('layouts.admin')


@section('content')
<form action="{{ route('delete.store') }}" method="POST">
    @csrf
    Name: <input type="text" name="name"><br><br>
    Email: <input type="email" name="email"><br><br>
    Phone: <input type="text" name="phone"><br><br>
    <input type="submit" value="SAVE">
</form>

<br><br><br>

<style>
    td, th{
        padding:10px;
    }
</style>

<table border="1">
    <tr>
        <th>name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>#</th>
    </tr>
@foreach($data as $test)
    <tr>
        <td>{{ $test->name }}</td>
        <td>{{ $test->email }}</td>
        <td>{{ $test->phone }}</td>
        <td>
            <form action="{{ route('delete.destroy', $test->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">DELETE</button>
            </form>
        </td>
        <td>
            <a href="{{ route('delete.show', $test->id) }}">Show</a>
        </td>
    </tr>
@endforeach
</table>
<br><br>


@endsection

