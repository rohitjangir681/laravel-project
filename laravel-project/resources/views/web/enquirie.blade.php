@extends('layouts.admin')
@section('content')
{{-- {{ $enquiries }}
{{ die(); }} --}}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Enquiry List
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                <td>{{ $i++ }}</td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>{{ $enquiry->message }}</td>
                                <td id="statusId{{ $enquiry->id }}">
                                    @if($enquiry->status == 1)
                                        <button data-id="{{ $enquiry->id }}" value="{{ $enquiry->status }}" class="btn btn-danger status_class">Unread</button>
                                    @else
                                        <button class="btn btn-success">Read</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.status_class').click(function(){
            statusId = $(this).attr('data-id');
            // console.log(statusId);
            $.ajax({
                url: "{{ route('enquiriy-status') }}",
                type: 'POST',
                data: {status_id: statusId, '_token': "{{csrf_token()}}"},
                success: function(result) {
                    // console.log(result);
                    $("td#statusId" + statusId).html(result);
                },
                error: function(error) {
                    alert(error);
                }
            });
        });
    });
</script>

@endsection
