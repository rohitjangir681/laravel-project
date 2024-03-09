<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit state page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>State edit page...</h1>

{{-- {{ $stateData->cities }} --}}

    <form action="{{ route('state.update', $stateData->id) }}" method="POST">
        @csrf
        @method('PUT')
    <table>
        <tr>
            <td>Country:</td>
            <td>
                <select name="country_id">
                    <option value="">Select Country</option>
                    @foreach($countryData as $_countryData)
                        <option value="{{ $_countryData->id }}" {{ ($stateData->country_id == $_countryData->id) ? 'selected':'' }}>{{ $_countryData->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>State Name:</td>
            <td>
                <input type="text" name="state_name" value="{{ $stateData->state_name }}">
            </td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="state_status">
                    <option value="">Select State</option>
                    <option value="1" {{ ($stateData->state_status==1) ? 'selected': '' }}>Enable</option>
                    <option value="2" {{ ($stateData->state_status==2) ? 'selected': '' }}>Disable</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>City:</td>
            <td>
                <table class="add_data_table">
                    <tr>
                        <td>Name</td>
                        <td>Status</td>
                        <td>
                            <button type="button" class="add_more">+</button>
                        </td>
                    </tr>
                @foreach($stateData->cities as $_cities)
                    <tr>
                        <td>
                            <input type="hidden" name="city_id[]" value="{{ $_cities->id }}">
                            <input type="text" name="city_name[]" value="{{ $_cities->city_name }}">
                        </td>
                        <td>
                            <select name="city_status[]">
                                <option value="">Select Status</option>
                                <option value="1" {{ ($_cities->city_status==1) ? 'selected':'' }}>Enable</option>
                                <option value="2" {{ ($_cities->city_status==2) ? 'selected':'' }}>Disable</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="remove">X</button>
                        </td>
                    </tr>
                @endforeach
                </table>
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
        $(".add_more").click(function(){
            var rowData =  `<tr>
                        <td>
                            <input type="text" name="city_name[]">
                        </td>
                        <td>
                            <select name="city_status[]">
                                <option value="">Select Status</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </td>
                        <td><button type="button" class="remove">X</button></td>
                    </tr>`;
                    $('.add_data_table').append(rowData);
        });
        $('body').delegate('.remove', 'click', function(){
            $(this).closest('tr').remove();
        });
    });
</script>
</body>
</html>