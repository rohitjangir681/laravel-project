<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Country Index page</title>
</head>
<body>
    
    <h1>Country Index page....</h1>

    <a href="{{ route('country.create') }}">Add Country</a>
    <br><br>

{{-- {{ $countrys }} --}}
<span style="color:green;">
    {{ session()->get('success') }}
</span>
<table border="1" cellspacing="0">
    <tr>
        <th>Country Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach ($countrys as $_country)
    
        <tr>
            <td>{{ $_country->name }}</td>
            <td>{{ ($_country->status==1) ? 'Enable' : 'Disable' }}</td>
            <td>
                <a href="{{ route('country.edit', $_country->id) }}">Edit</a>
                <form action="{{ route('country.destroy', $_country->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="DELETE" name="delete">
                </form>
            </td>
        </tr>
    @endforeach

</table>


<br><br>
<a href="{{ route('state.index') }}">State index page</a><br><br>
<a href="{{ route('city.index') }}">City index page</a>

</body>
</html>