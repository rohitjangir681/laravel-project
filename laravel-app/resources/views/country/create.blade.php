<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Country Create Country</title>
    <script src="{{ asset('js/jquery.js') }}"></script>

</head>
<body>
    <h1>Create country page...</h1>

    <form action="{{ route('country.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>Country:</th>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    <select name="status">
                        <option value="">Select Status</option>
                        <option value="1">Enable</option>
                        <option value="2">Disable</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>States:</th>
                <td>
                    <table class="add_tr_table">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <td>
                                <button type="button" class="add_more">+</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="state_name[]">
                            </td>
                            <td>
                                <select name="state_status[]">
                                    <option value="">Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="2">Disable</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="SAVE" name="save">
                </td>
            </tr>
        </table>
    </form>


<script>
    $(document).ready(function() {
        $(".add_more").click(function(){
            var tableRow = '<tr>\
                        <td>\
                        <input type="text" name="state_name[]">\
                        </td>\
                        <td>\
                        <select name="state_status[]">\
                        <option value="">Select Status</option>\
                        <option value="1">Enable</option>\
                        <option value="2">Disable</option>\
                        </select>\
                        </td>\
                        <td><button type="button" class="remove">X</button></td>\
                        </tr>';

                        $(".add_tr_table").append(tableRow);
        });

        $(".add_tr_table").delegate('.remove', 'click', function() {
            $(this).closest('tr').remove();
        });

    });
</script>


</body>
</html>