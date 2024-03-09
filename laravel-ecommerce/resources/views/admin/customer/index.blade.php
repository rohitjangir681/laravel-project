@extends('layouts.admin')

@section('content')

<section class="content-header">
    <h1>
        Manage customers
    </h1>
</section>

{{-- {{ $orders }} --}}

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Customer Page</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 
                  <table id="myTable" class="table table-bordered display">
                    <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @php
                    $i=1;   
                  @endphp
                  <tbody>
                    @forelse($customers as $_customer)
                    <tr>
                        <td>{{ $i++ . '.' }}</td>
                        <td>{{ $_customer->name }}</td>
                        <td>{{ $_customer->email }}</td>
                        <td>
                            <a href="{{ route('manage.customer.show', $_customer->id) }}" class="btn btn-primary">View</a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="20" align="center">No order</td>
                      </tr>
                      @endforelse
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              
              </div><!-- /.box -->
        </div>
    </div>



</section>

@endsection
