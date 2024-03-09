<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
     <!-- PAGE LEVEL SCRIPTS -->
     <script src="{{ asset('assets/js/bootstrap-fileupload.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
                }
            })
            .catch( error => {
                  
            } );

    </script>