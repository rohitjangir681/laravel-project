<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Show page</title>
</head>
<body>
    <h1>Student show page...</h1>

{{-- {{ $studentData }} --}}

<ul>
    @foreach($studentData as $_studentData)
        <li><b>First Name: </b>{{ $_studentData->first_name }}</li>
        <li><b>Last Name: </b>{{ $_studentData->last_name }}</li>
        <li><b>Date of birth: </b>{{ $_studentData->dob }}</li>
        <li><b>Email: </b>{{ $_studentData->email }}</li>
        <li><b>Mobile Number: </b>{{ $_studentData->mobile_number }}</li>
        <li><b>Gender: </b>{{ $_studentData->gender }}</li>
        <li><b>Address: </b>{{ $_studentData->address }}</li>
        <li><b>City: </b>{{ $_studentData->city }}</li>
        <li><b>PIN Code: </b>{{ $_studentData->pin_code }}</li>
        <li><b>State: </b>{{ $_studentData->state }}</li>
        <li><b>Country: </b>{{ $_studentData->country }}</li>
        <li><b>Hobbies: </b>{{ $_studentData->hobbies }}</li>
        <li><b>Courses: </b>{{ $_studentData->courses }}</li>
    @endforeach
</ul>

</body>
</html>