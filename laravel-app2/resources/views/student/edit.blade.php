<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student page....</h1>

    <form action="{{ route('student.update', $stData->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ $stData->first_name }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Last name</label>
                    <input type="text" name="last_name" value="{{ $stData->last_name }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $stData->email }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile_number" value="{{ $stData->mobile_number }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Gender</label>
                    <input type="radio" name="gender" value="m" {{ ($stData->gender=='m') ? 'checked': '' }}>Male
                    <input type="radio" name="gender" value="f" {{ ($stData->gender=='f') ? 'checked': '' }}>FeMale
                </td>
            </tr>
            <tr>
                <td>
                    <label>Hobbies</label>
                    @php
                        $stExplode = explode(',', $stData->hobbies);
                    @endphp
                    <input type="checkbox" name="hobbies[]" value="F_Hobbies" {{ (in_array('F_Hobbies', $stExplode ?? NULL) ? 'checked' : '') }}>F_Hobbies
                    <input type="checkbox" name="hobbies[]" value="S_Hobbies" {{ (in_array('S_Hobbies', $stExplode ?? NULL) ? 'checked' : '') }}>S_Hobbies
                    <input type="checkbox" name="hobbies[]" value="T_Hobbies" {{ (in_array('T_Hobbies', $stExplode ?? NULL) ? 'checked' : '') }}>T_Hobbies
                    <input type="checkbox" name="hobbies[]" value="F_Hobbies" {{ (in_array('F_Hobbies', $stExplode ?? NULL) ? 'checked' : '') }}>F_Hobbies
                    <input type="checkbox" name="hobbies[]" value="E_Hobbies" {{ (in_array('E_Hobbies', $stExplode ?? NULL) ? 'checked' : '') }}>E_Hobbies
                </td>
            </tr>
    
            <tr>
                <td>
                    <label>Qualification</label>
                    @php
                        $qualFicationEx = explode(',', $stData->qualification);
                    @endphp
                    <input type="checkbox" name="qualification[]" value="10" {{ (in_array('10', $qualFicationEx ?? Null)) ? 'checked':'' }}>10
                    <input type="checkbox" name="qualification[]" value="11" {{ (in_array('11', $qualFicationEx ?? Null)) ? 'checked':'' }}>11
                    <input type="checkbox" name="qualification[]" value="12" {{ (in_array('12', $qualFicationEx ?? Null)) ? 'checked':'' }}>12
                    <input type="checkbox" name="qualification[]" value="13" {{ (in_array('13', $qualFicationEx ?? Null)) ? 'checked':'' }}>13
                </td>
            </tr>
            <tr>
                <td>
                    <label>Courses</label>
                    <input type="radio" name="courses" value="a" {{ ($stData->courses=='a') ? 'checked':'' }}>A
                    <input type="radio" name="courses" value="b" {{ ($stData->courses=='b') ? 'checked':'' }}>B
                    <input type="radio" name="courses" value="c" {{ ($stData->courses=='c') ? 'checked':'' }}>C
                    <input type="radio" name="courses" value="d" {{ ($stData->courses=='d') ? 'checked':'' }}>D
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="UPDATE">
                </td>
            </tr>
        </table>
    </form>
    


</body>
</html>