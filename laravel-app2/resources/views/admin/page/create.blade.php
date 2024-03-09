@extends('layouts.admin')

@section('content')
    <form action="{{ route('page.store') }}" method="POST">
        @csrf

        Parent Page: <select name="parent_id">
            <option value="" selected>Select Parent Page</option>

            @foreach (getPagesMenu() as $page)
                <option value="{{ $page->id }}">{{ $page->name }}</option>
                @foreach (getSubMenu($page->id) as $subPage)
                    <option value="{{ $subPage->id }}">-{{ $subPage->name }}</option>
                    @foreach(getSubSubMenu($subPage->id) as $subSubPage)
                        <option value="{{ $subSubPage->id }}">--{{ $subSubPage->name }}</option>
                    @endforeach
                @endforeach
            @endforeach
        </select><br><br>

        Page Name: <input type="text" name="name"><br><br>
        Page Heading: <input type="text" name="heading"><br><br>
        Page Url Key: <input type="text" name="url_key"><br><br>
        Page Description:
        <textarea name="description" cols="30" rows="3"></textarea>
        <input type="submit" value="SAVE">
    </form>


<br><br>

<h1>Image </h1>

<form action="{{ route('customimage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image_name">
    <button type="submit">Submit</button>
</form>




@endsection
