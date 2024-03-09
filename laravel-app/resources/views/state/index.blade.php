<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>State index page</title>
</head>
<body>
    <h1>State index page...</h1>

<a href={{ route('state.create') }}>Add State</a>


<table border="1" cellspacing="0">
    <tr>
        <th>State Name</th>
        <th>Status</th>
        <th>Country Name</th>
        <th>#</th>
    </tr>
    @foreach ($states as $_state)
        <tr>
            <td>{{ $_state->state_name }}</td>
            <td>{{ ($_state->state_status==1) ? 'Enable': 'Disable' }}</td>
            <td>{{ $_state->country->name }}</td>
            <td>
                <a href="{{ route('state.edit', $_state->id) }}">Edit</a>
                <form action="{{ route('state.destroy', $_state->id) }}" method="POST">
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
<a href="{{ route('city.index') }}">City Page</a>

</body>
</html>