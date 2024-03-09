<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Edit page</title>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
    
<h1>City Edit page...</h1>


{{-- {{ $cityData }}
{{die()}} --}}


<form action="{{ route('city.update', $cityData->id) }}" method="POST">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td>Select Country:</td>
            <td>

                <select name="country_id" id="country_id">
                    <option value="">Select Country</option>
                    @foreach ($countryData as $_countryData) 
                        <option value="{{ $_countryData->id }}" {{ ($_countryData->id==$cityData->country_id) ? 'selected':'' }}>{{ $_countryData->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td>Select State:</td>
            <td>
                <select name="state_id" id="state_id">
                    <option value="">Select State</option>
                    @foreach($stateData as $_stateData)
                        <option value="{{ $_stateData->id }}" {{ ($_stateData->id==$cityData->state_id) ? 'selected' : '' }} >{{ $_stateData->state_name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td>City:</td>
            <td>
                <input type="text" name="city_name" value="{{ $cityData->city_name }}">
            </td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="city_status">
                    <option value="">Select Status</option>
                    <option value="1" {{ ($cityData->city_status==1) ? 'selected':'' }}>Enable</option>
                    <option value="2" {{ ($cityData->city_status==2) ? 'selected':'' }}>Disable</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="UPDATE">
            </td>
        </tr>
    </table>
</form>

<script>
    $(document).ready(function(){
        $("#country_id").change(function(){
            let countryId = $(this).val();
            $.ajax({
                url: '{{ route("country-state") }}',
                method: 'GET',
                data: {'cnt_id': countryId},
                success: function(response) {
                    $('#state_id').html(response);
                },
                error: function(er) {
                    console.log(er);
                }
            });
        });
    });
</script>


</body>
</html>