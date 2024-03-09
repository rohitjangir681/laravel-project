<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Create page</title>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
    <h1>City page...</h1>

{{-- 
@foreach ($stateData as $_value) 
    <select name="">
        <option value="">{{ $_value->country_id }}</option>
    </select>
@endforeach --}}


    <form action="{{ route('city.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Select Country:</td>
                <td>

                    <select name="country_id" id="country_id">
                        <option value="">Select Country</option>
                        @foreach ($countryData as $key => $_value) 
                            <option value="{{ $_value->id }}">{{ $_value->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td>Select State:</td>
                <td>
                    <select name="state_id" id="state_id">
                        <option value="">Select State</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>City:</td>
                <td>
                    <input type="text" name="city_name">
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="city_status">
                        <option value="">Select Status</option>
                        <option value="1">Enable</option>
                        <option value="2">Disable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="SAVE">
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