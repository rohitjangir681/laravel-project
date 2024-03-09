@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category information</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Category information</h3>
                        @can('category_edit')
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary"
                                style="float: right;">Edit category</a>
                        @endcan
                        <a href="{{ route('category.index') }}" class="btn btn-primary"
                            style="float: right; margin-right:10px;">Back</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">

                            <tr>
                                <th>Category Name</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>Category Status</th>
                                <td>{{ $category->status == 1 ? 'Enable' : 'Disable' }}</td>
                            </tr>

                            <tr>
                                <th>Show in Menu</th>
                                <td>{{ $category->show_in_menu == 1 ? 'YES' : 'NO' }}</td>
                            </tr>

                            <tr>
                                <th>Short Description</th>
                                <td>{{ $category->short_description }}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td>{!! $category->description !!}</td>
                            </tr>

                            <tr>
                                <th>URL Key</th>
                                <td>{{ $category->url_key }}</td>
                            </tr>

                            <tr>
                                <th>Meta Tag</th>
                                <td>{{ $category->meta_tag }}</td>
                            </tr>

                            <tr>
                                <th>Meta Title</th>
                                <td>{{ $category->meta_title }}</td>
                            </tr>

                            <tr>
                                <th>Meta Description</th>
                                <td>{{ $category->meta_description }}</td>
                            </tr>

                            <tr>
                                <th>Parent Category</th>

                                <td>{{ getCategoryName($category->category_parent_id) }}</td>

                            </tr>







                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
@endsection
