@extends('layouts.admin')

@section('content')
    {{-- {{ $blocks }} --}}
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Block List
                </div>
                <div class="panel-body">
                    @can('block_create')
                        <a href="{{ route('block.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add Block</a>
                    @endcan
                    <div class="table-responsive">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Identifier</th>
                                    <th>Heading</th>
                                    <th>Ordering</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($blocks as $block)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $block->title }}</td>
                                        <td>{{ $block->identifier }}</td>
                                        <td>{{ $block->heading }}</td>
                                        <td>{{ $block->ordering }}</td>
                                        <td>{{ $block->status == 1 ? 'Enable' : 'Disable' }}</td>
                                        <td><img src="{{ $block->getFirstMediaUrl('image') }}" style="width: 200px;"></td>
                                        <td>
                                            @can('block_edit')
                                                <a href="{{ route('block.edit', $block->id) }}" class="btn btn-primary"
                                                    style="float:left;margin-right:5px;"><i
                                                        class="glyphicon glyphicon-edit"></i>Edit</a>
                                            @endcan
                                            @can('block_delete')
                                                <form action="{{ route('block.destroy', $block->id) }}" method="POST"
                                                    style="float:left;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="glyphicon glyphicon-trash"></i>Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" colspan="7">No data found..</td>
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
