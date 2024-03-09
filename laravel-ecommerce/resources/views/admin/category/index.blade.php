@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category list</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Category list</h3>
                        @can('category_create')
                            <a href="{{ route('category.create') }}" class="btn btn-primary" style="float: right;">Category add</a>
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
                                    <th>Category name</th>
                                    <th>Status</th>
                                    <th>Show in Menu</th>
                                    <th>Url Key</th>
                                    <th>Products</th>
                                    @if (Gate::allows('category_edit') or Gate::allows('category_delete') or Gate::allows('category_show'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status == 1 ? 'Enable' : 'Disable' }}</td>
                                        <td>{{ $category->show_in_menu == 1 ? 'YES' : 'NO' }}</td>
                                        <td>{{ $category->url_key }}</td>
                                        <td>{{ implode(', ', $category->products()->pluck('name')->toArray()) }}</td>
                                        @if (Gate::allows('category_edit') or Gate::allows('category_delete') or Gate::allows('category_show'))
                                            <td>
                                                @can('category_edit')
                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                        class="btn btn-primary" style="float: left;margin-right:4px;">Edit</a>
                                                @endcan
                                                @can('category_show')
                                                    <a href="{{ route('category.show', $category->id) }}"
                                                        class="btn btn-success" style="float: left;margin-right:4px;">Show</a>
                                                @endcan
                                                @can('category_delete')
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center">No Category.</td>
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
