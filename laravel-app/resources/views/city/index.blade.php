<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City index</title>
</head>
<body>
    <h1>City page...</h1>
    <a href="{{ route('city.create') }}">Add City</a>
    <br><br>
    <span style="color: green;">
        {{ session()->get('success') }}
    </span>


{{-- {{ now() }} --}}

    {{-- {{ $city_data }} --}}

    <table border="1" cellspacing="0">
        <tr>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($city_data as $_city_data)
        <tr>
            <td>{{ $_city_data->city_name }}</td>
            <td>{{ $_city_data->state->state_name ?? 'No state' }}</td>
            <td>{{ $_city_data->country->name }}</td>
            <td>{{ ($_city_data->city_status==1) ? 'Enable': 'Disable' }}</td>
            <td>
                <a href="{{ route('city.edit', $_city_data->id) }}">Edit</a>
                <form action="{{ route('city.destroy', $_city_data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="DELETE">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
<br><br>
<a href="{{ route('country.index') }}">Country Page</a><br><br>
<a href="{{ route('state.index') }}">State Page</a>

</body>
</html>
