@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Coupon list</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Coupon list</h3>
                        @can('coupon_create')
                            <a href="{{ route('coupon.create') }}" class="btn btn-primary" style="float: right;">Coupon add</a>
                        @endcan
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="margin-top: 20px;">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Coupon Code</th>
                                    <th>Valid From</th>
                                    <th>Valid To</th>
                                    <th>Discount Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $coupon->title }}</td>
                                        <td>{{ ($coupon->status==1) ? 'Enable' : 'Disable' }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->valid_from }}</td>
                                        <td>{{ $coupon->valid_to }}</td>
                                        <td>{{ $coupon->discount_amount }}</td>
                                        <td>
                                            @can('coupon_edit')
                                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('coupon_delete')
                                            <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" align="center">No Coupon.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
@endsection
