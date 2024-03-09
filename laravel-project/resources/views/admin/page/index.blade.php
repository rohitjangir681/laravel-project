@extends('layouts.admin')

@section('content')
{{-- {{ $pages }} --}}
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Page List
            </div>
            <div class="panel-body">
                @can('page_create')
                    <a href="{{ route('page.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add Page</a>
                @endcan
                <div class="table-responsive">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Ordering</th>
                                <th>Status</th>
                                <th>Url Key</th>
                                <th>Image</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @forelse($pages as $page)
                                <tr>
                                    <td>{{ $i++ . '.' }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->heading }}</td>
                                    <td>{{ $page->ordering }}</td>
                                    <td>{{ ($page->status==1) ? 'Enable' : 'Disable' }}</td>
                                    <td>{{ $page->url_key }}</td>
                                    <td>
                                        <img src="{{ $page->getFirstMediaUrl('image') }}" alt="" style="width: 200px;">
                                    </td>
                                    <td>
                                        @can('page_edit')
                                            <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary" style="float:left;margin-right:4px;"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                                        @endcan
                                        @can('page_delete')
                                            <form action="{{ route('page.destroy', $page->id) }}" method="POST" style="float: left;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" align="center">Data not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection