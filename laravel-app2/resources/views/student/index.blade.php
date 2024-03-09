<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index page</title>
</head>
<body>
    
<h1>Index page...</h1>
<a href="{{ route('student.create') }}">Add Student</a>
{{-- {{$students}} --}}

<span style="color:green;width:100%;display:block;">
{{ session()->get('success') }}
</span>
<table border="1" cellspacing="0">
    <tr>
        <th>Sr No.</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Qualification</th>
        <th>Courses</th>
        <th>Action</th>
    </tr>
    @php
        $i = 1;
    @endphp
@foreach ($students as $_student)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $_student->first_name }}</td>
        <td>{{ $_student->last_name }}</td>
        <td>{{ $_student->email }}</td>
        <td>{{ $_student->mobile_number }}</td>
        <td>{{ ($_student->gender=='m') ? 'Male': 'FeMale' }}</td>
        <td>{{ $_student->hobbies }}</td>
        <td>{{ $_student->qualification }}</td>
        <td>{{ $_student->courses }}</td>
        <td>
            <a href="{{ route('student.edit', $_student->id) }}">Edit</a>
            <form action="{{ route('student.destroy', $_student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" name="delete" value="DELEET">
            </form>
        </td>
    </tr>
@endforeach
    

</table>

{{-- {{ $students->links() }} --}}

</body>
</html>