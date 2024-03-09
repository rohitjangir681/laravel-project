<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <form action="{{ route('student.store') }}" method="POST">
        @csrf
        <table>
            <tr>

                <td> 
                    <label>First Name:</label>
                </td>
                <td>
                    <input type="text" name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')
                    <span class="error">
                        {{$message}}
                    </span>
                    @enderror

                </td>
            </tr>
            <tr>
                <td>
                    <label>Last Name:</label>
                </td>
                <td>
                    <input type="text" name="last_name">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Date of Birth:</label>
                </td>
                <td>
                    <input type="date" name="dob">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email Id:</label>
                </td>
                <td>
                    <input type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <label>Mobile Number:</label>
                </td>
                <td>
                    <input type="tel" name="mobile_number">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Gender:</label>
                </td>
                <td>
                    Male <input type="radio" name="gender" value="m" {{ (old('gender')=='m') ? 'checked':'' }}>
                    FeMale<input type="radio" name="gender" value="f" {{ (old('gender')=='f') ? 'checked':'' }}>
                    @error('gender')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <label>Address:</label>
                </td>
                <td>
                    <textarea name="address" cols="30" rows="3"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>City:</label>
                </td>
                <td>
                    <input type="text" name="city">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Pin Code:</label>
                </td>
                <td>
                    <input type="number" name="pin_code">
                </td>
            </tr>
            <tr>
                <td>
                    <label>State:</label>
                </td>
                <td>
                    <input type="text" name="state">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Country:</label>
                </td>
                <td>
                    <input type="text" name="country">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Hobbies:</label>
                </td>
                <td>
                Drawing<input type="checkbox" name="hobbies[]" value="Drawing" {{ (in_array('Drawing', (old('hobbies')??[]))) ? 'checked':'' }}> 
                Singing<input type="checkbox" name="hobbies[]" value="Singing" {{ (in_array('Singing', (old('hobbies')??[]))) ? 'checked':'' }}> 
                Dancing<input type="checkbox" name="hobbies[]" value="Dancing" {{ (in_array('Dancing', (old('hobbies')??[]))) ? 'checked':'' }}> 
                Sketching<input type="checkbox" name="hobbies[]" value="Sketching" {{ (in_array('Sketching', (old('hobbies')??[]))) ? 'checked':'' }}><br>
                @error('hobbies')
                    <span class="error">
                        {{ $message }}
                    </span>
                @enderror
                {{-- <br>
                Others <input type="checkbox" name="others" value="Others">
                <input type="text" name="others"> --}}

                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Courses Applied For:</label>
                </td>
                <td>
                    BCA <input type="radio" name="courses" value="bca">
                    B.Com <input type="radio" name="courses" value="b_com">
                    B.Sc <input type="radio" name="courses" value="b_sc">
                    B.A. <input type="radio" name="courses" value="ba">
                </td>
            </tr>

            <tr>
                <td>
                    <label>Qualifications:</label>
                </td>
                <td>
                    <table>
                        <tr>
                            <td align="center">Examination</td>
                            <td align="center">Board</td>
                            <td align="center">Percentage</td>
                            <td align="center">Year of Passing</td>
                        </tr>
                        <tr>    
                            <td>
                                <input type="text" value="Class X" name="examination[]" readonly>
                            </td>
                            <td>
                                <input type="text" name="board[]" value="{{ old('board.0') }}">
                                @error('board.*')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" name="percentage[]" value="{{ old('percentage.0') }}">
                            </td>
                            <td>
                                <input type="number" min="2000" max="2099" step="1" value="2010" name="year_of_passing[]">
                            </td>
                        </tr>
                        
                        <tr>    
                            <td>
                                <input type="text" value="Class XII" name="examination[]" readonly>
                            </td>
                            <td>
                                <input type="text" name="board[]" value="{{ old('board.1') }}">
                            </td>
                            <td>
                                <input type="number" name="percentage[]" value="{{ old('percentage.1') }}">
                            </td>
                            <td>
                                <input type="number" min="2000" max="2099" step="1" value="2010" name="year_of_passing[]">
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                <input type="text" value="Graduation" name="examination[]" readonly>
                            </td>
                            <td>
                                <input type="text" name="board[]" value="{{ old('board.2') }}">
                            </td>
                            <td>
                                <input type="number" name="percentage[]" value="{{ old('percentage.2') }}">
                            </td>
                            <td>
                                <input type="number" min="2000" max="2099" step="1" value="2010" name="year_of_passing[]">
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                <input type="text" value="Masters" name="examination[]" readonly>
                            </td>
                            <td>
                                <input type="text" name="board[]" value="{{ old('board.3') }}">
                            </td>
                            <td>
                                <input type="number" name="percentage[]" value="{{ old('percentage.3') }}">
                            </td>
                            <td>
                                <input type="number" min="2000" max="2099" step="1" value="2010" name="year_of_passing[]">
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <tr>
            <td></td>
            <td>
                <input type="submit" value="Submit">
                <button type="reset">Reset</button>
            </td> 
            </tr>
        </table>
    </form>

</body>

</html>