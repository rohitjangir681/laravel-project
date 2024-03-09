@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Product list</h1>
    </section>

    {{-- {{ $products }} --}}

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product list</h3>
                        @can('product_create')
                            <a href="{{ route('product.create') }}" class="btn btn-primary" style="float: right;">Product add</a>
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
                                    <th>Product name</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Qty</th>
                                    <th>Stock status</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Categories</th>
                                    <th>Related Product</th>
                                    <th>Special price</th>
                                    <th>Special price from</th>
                                    <th>Special price to</th>
                                    @if (Gate::allows('product_delete') or Gate::allows('product_edit') or Gate::allows('product_show'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{!! $product->status == 1
                                            ? '<span class="label label-success">Enable</span>'
                                            : '<span class="label label-danger">Disable</span>' !!}</td>
                                        <td>{!! $product->is_featured == 1
                                            ? '<span class="label label-success">YES</span>'
                                            : '<span class="label label-danger">NO</span>' !!}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{!! $product->stock_status == 1
                                            ? '<span class="label label-success">In Stock</span>'
                                            : '<span class="label label-danger">Out of Stock</span>' !!}</td>
                                        <td>{{ $product->weight }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ implode(', ', $product->categories()->pluck('name')->toArray()) }}</td>
                                        <td>{{ $product->related_product }}</td>
                                        <td>{{ $product->special_price }}</td>
                                        <td>{{ $product->special_price_from }}</td>
                                        <td>{{ $product->special_price_to }}</td>
                                        @if (Gate::allows('product_delete') or Gate::allows('product_edit') or Gate::allows('product_show'))
                                            <td>
                                                @can('product_edit')
                                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"
                                                        style="float: left;">Edit</a>
                                                @endcan
                                                @can('product_show')
                                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-success"
                                                        style="float: left;">Show</a>
                                                @endcan
                                                @can('product_delete')
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                        style="float: left;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this product')">DELETE</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" align="center">No product.</td>
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
