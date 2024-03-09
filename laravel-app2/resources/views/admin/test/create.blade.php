@extends('layouts.admin')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <form action="{{ route('ckeditor.store') }}" method="POST">
        @csrf
        Name: <input type="text" name="name"><br><br>
        Text: <textarea id="editor" name="description"></textarea><br><br>
        <input type="submit" value="SAVE">
    </form>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    
@endsection