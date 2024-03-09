@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Coupon Add</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Coupon Add</h3>
                        @can('coupon_index')
                        <a href="{{ route('coupon.index') }}" type="button" class="btn btn-primary"
                            style="float: right;">Coupon List</a>
                            @endcan
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <label for="title">Enter Coupon Title:</label>
                            <div class="form-group @error('title') has-error @enderror">
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter coupon title" value="{{ old('title') }}">
                                @error('title')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="status">Select Status:</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable</option>
                                </select>
                                @error('status')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>


                            <label for="coupon_code">Coupon Code:</label>
                            <div class="form-group @error('coupon_code') has-error @enderror">
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                                    placeholder="Enter coupon code" value="{{ old('coupon_code') }}">
                                @error('coupon_code')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="valid_from">Valid From:</label>
                            <div class="form-group @error('valid_from') has-error @enderror">
                                <input type="datetime-local" name="valid_from" id="valid_from" class="form-control"
                                    placeholder="Valid from" value="{{ old('valid_from') }}">
                                @error('valid_from')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="valid_to">Valid To:</label>
                            <div class="form-group @error('valid_to') has-error @enderror">
                                <input type="datetime-local" name="valid_to" id="valid_to" class="form-control"
                                    placeholder="Valid to" value="{{ old('valid_to') }}">
                                @error('valid_to')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>


                            <label for="discount_amount">Discount Amount:</label>
                            <div class="form-group @error('discount_amount') has-error @enderror">
                                <input type="number" name="discount_amount" id="discount_amount" step="0.01"
                                    class="form-control" placeholder="Discount amount"
                                    value="{{ old('discount_amount') }}">
                                @error('discount_amount')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
