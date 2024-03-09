@extends('layouts.admin')

@section('content')

<section class="content-header">
    <h1>
        Enquiries
    </h1>
</section>

{{-- {{ $enquiries }} --}}

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Enquiry Page</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="myTable" class="table table-bordered display">
                    <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach($enquiries as $enquiry)
                    <tr>
                      <td>{{ $i++ . '.' }}</td>
                      <td>{{ $enquiry->name }}</td>
                      <td>{{ $enquiry->email }}</td>
                      <td>{{ $enquiry->phone }}</td>
                      <td>{{ $enquiry->message }}</td>
                      <td id="statusId{{ $enquiry->id }}">
                        @if($enquiry->status == 2)
                          <button type="button" data-id="{{ $enquiry->id }}" class="btn btn-warning read_unread">Unread</button>
                        @else
                          <button type="button" class="btn btn-primary">Read</button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              
              </div><!-- /.box -->
        </div>
    </div>

  

    <script>
      $(document).ready(function(){
        $(".read_unread").click(function(){
          var statusId = $(this).attr('data-id');
          
          // console.log(statusId);


          $.ajax({
            url: "{{ route('enquiriy.status') }}",
            type: "POST",
            data: {status_id: statusId, '_token': "{{ csrf_token() }}"},
            success: function(result) {
              // console.log(result);
              $('#statusId' + statusId).html(result);
            },
            error: function(er) {
              alert(er);
            }
          });

        });
      });
    </script>





</section>

@endsection
