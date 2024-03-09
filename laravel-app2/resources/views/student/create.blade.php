<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student...</h1>
    

<form action="{{ route('student.store') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td>
                <label>First Name</label>
                <input type="text" name="first_name">
            </td>
        </tr>
        <tr>
            <td>
                <label>Last name</label>
                <input type="text" name="last_name">
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
                <input type="email" name="email">
            </td>
        </tr>
        <tr>
            <td>
                <label>Mobile Number</label>
                <input type="tel" name="mobile_number">
            </td>
        </tr>
        <tr>
            <td>
                <label>Gender</label>
                <input type="radio" name="gender" value="m">Male
                <input type="radio" name="gender" value="f">FeMale
            </td>
        </tr>
        <tr>
            <td>
                <label>Hobbies</label>
                <input type="checkbox" name="hobbies[]" value="F_Hobbies">F_Hobbies
                <input type="checkbox" name="hobbies[]" value="S_Hobbies">S_Hobbies
                <input type="checkbox" name="hobbies[]" value="T_Hobbies">T_Hobbies
                <input type="checkbox" name="hobbies[]" value="F_Hobbies">F_Hobbies
                <input type="checkbox" name="hobbies[]" value="E_Hobbies">E_Hobbies
            </td>
        </tr>

        <tr>
            <td>
                <label>Qualification</label>
                <input type="checkbox" name="qualification[]" value="10">10
                <input type="checkbox" name="qualification[]" value="11">11
                <input type="checkbox" name="qualification[]" value="12">12
                <input type="checkbox" name="qualification[]" value="13">13
            </td>
        </tr>
        <tr>
            <td>
                <label>Courses</label>
                <input type="radio" name="courses" value="a">A
                <input type="radio" name="courses" value="b">B
                <input type="radio" name="courses" value="c">C
                <input type="radio" name="courses" value="d">D
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="SUBMIT">
            </td>
        </tr>
    </table>
</form>


</body>
</html>