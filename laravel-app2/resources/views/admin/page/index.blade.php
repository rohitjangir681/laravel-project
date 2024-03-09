@extends('layouts.admin')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
    th, td{
        padding: 10px;
    }
</style>

<a href="{{ route('page.create') }}">Add new page</a>
<br><br>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Heading</th>
        <th>Url Key</th>
        <th>Description</th>
    </tr>

@foreach($pages as $page)
    <tr>
        <td>{{ $page->name }}</td>
        <td>{{ $page->heading }}</td>
        <td>{{ $page->url_key }}</td>
        <td>{{ $page->description }}</td>
    </tr>
@endforeach

</table>

<br><br>

<div class="class_name">
    <button type="button" id="select_all">Select ALL</button><br>
    <input type="checkbox">Checkbox <br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
    <input type="checkbox">Checkbox<br>
</div>

<script>
    $("#select_all").click(function(){
        var forCheck = $(".class_name input[type='checkbox']");

        // $(forCheck).attr("checked", "checked");
        // $(forCheck).removeAttr("checked");


        if(!($(forCheck).attr('checked'))) {
            $(forCheck).attr("checked", true);
        } else {
            $(forCheck).removeAttr("checked", false);
        }

    });
</script>




@endsection