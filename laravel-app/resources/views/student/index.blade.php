<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    
<h1>This is index file</h1>
{{ session()->get('success') }}
<a href="{{ route('student.create') }}">Add Student</a><br>
<br> <br>

{{-- {{dd($students)}} --}}



<table border="1" cellspacing="0" class="table table-bordered">
    <thead>
        <tr>
            <th>Sr.No.</th> 
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of birth</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Gender</th>
            <th>Address</th>
            <th>City</th>
            <th>Pin Code</th>
            <th>State</th>
            <th>Country</th>
            <th>Habbies</th>
            {{-- <th>Qualification</th> --}}
            <th>Courses</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php
    $i = 1;   
    @endphp
    @if ($students->count())
        

    @foreach($students as $_student)
 
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $_student->first_name }}</td>
        <td>{{ $_student->last_name }}</td>
        <td>{{ $_student->dob }}</td>
        <td>{{ $_student->email }}</td>
        <td>{{ $_student->mobile_number }}</td>
        <td>{{ ($_student->gender=='m')?"Male":"FeMale" }}</td>
        <td>{{ $_student->address }}</td>
        <td>{{ $_student->city }}</td>
        <td>{{ $_student->pin_code }}</td>
        <td>{{ $_student->state }}</td>
        <td>{{ $_student->country }}</td>
        <td>{{ $_student->hobbies }}</td>
        <td>{{ $_student->courses }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('student.edit', $_student->id) }}">Edit</a> 
            <a href="{{ route('student.show', $_student->id) }}" class="btn btn-info">Show</a>
            <form action="{{ route('student.destroy', $_student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="DELETE" name="delete">
            </form>
        </td>
    </tr>
    @endforeach 

    @else
    <tr>
        <td colspan="15" align="center">Data Not found...</td>
    </tr>
    @endif
    </tbody>
</table>

<div class="pagination_class mt-5">
{{ $students->links('pagination::bootstrap-5') }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>




</body>
</html>