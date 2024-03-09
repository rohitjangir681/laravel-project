@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Customer Order
        </h1>
    </section>

    {{-- {{ $orders }} --}}

    {{-- {{ $customer }} --}}

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer Details</h3>
                    </div>
                    <div class="box-body">
                        <h4><strong>Name:</strong> {{ $customer->name }}</h4>
                        <h4><strong>Email:</strong> {{ $customer->email }}</h4>
                    </div>
                    <hr>

                    <div class="box-header">
                        <h3 class="box-title">Customer Order</h3>
                    </div>
                    <div class="box-body">

                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                                @forelse($orders as $_order)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $_order->order_increment_id }}</td>
                                        <td>{{ $_order->name }}</td>
                                        <td>{{ $_order->email }}</td>
                                        <td>{{ $_order->created_at }}</td>
                                        <td>
                                            <a href="{{ route('manage.customer.order.show', $_order->id) }}"
                                                class="btn btn-primary">View</a>
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
