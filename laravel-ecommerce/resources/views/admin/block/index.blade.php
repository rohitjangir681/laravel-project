@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Block List</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Block List</h3>
                        <a href="{{ route('block.create') }}" class="btn btn-primary" style="float: right;">Add block</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Ordering</th>
                                <th>Identifier</th>
                                <th>Status</th>
                                <th>Image</th>
                                @if (Gate::allows('block_edit') or Gate::allows('block_delete'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @forelse($blocks as $block)
                                <tr>
                                    <td>{{ $i++ . '.' }}</td>
                                    <td>{{ $block->title }}</td>
                                    <td>{{ $block->heading }}</td>
                                    <td>{{ $block->ordering }}</td>
                                    <td>{{ $block->identifier }}</td>
                                    <td>{{ $block->status == 1 ? 'Enable' : 'Disable' }}</td>
                                    <td style="width: 150px;"><img src="{{ $block->getFirstMediaUrl('image') }}"
                                            alt="" style="width:100%;"></td>
                                    @if (Gate::allows('block_edit') or Gate::allows('block_delete'))
                                        <td>
                                            @can('block_edit')
                                                <a href="{{ route('block.edit', $block->id) }}" class="btn btn-primary"
                                                    style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                            @endcan
                                            @can('block_delete')
                                                <form action="{{ route('block.destroy', $block->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>DELETE</button>
                                                </form>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" align="center">No data found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section>
@endsection
