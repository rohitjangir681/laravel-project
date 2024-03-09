@extends('layouts.admin')

@section('content')
    {{-- {{ $sliders }} --}}
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Slider List
                </div>
                <div class="panel-body">
                    @can('slider_create')
                        <a href="{{ route('slider.create') }}" class="btn btn-primary" style="margin-bottom: 12px;">Add Slider</a>
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
                                @forelse($sliders as $slider)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->ordering }}</td>
                                        <td>{{ $slider->status == 1 ? 'Enable' : 'Disable' }}</td>
                                        <td>
                                            <img src="{{ $slider->getFirstMediaUrl('image') }}" style="width: 200px;">
                                        </td>
                                        <td>
                                            @can('slider_edit')
                                                <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary"
                                                    style="float: left;margin-right:4px;"><i
                                                        class="glyphicon glyphicon-edit"></i>Edit</a>
                                            @endcan
                                            @can('slider_delete')
                                                <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="glyphicon glyphicon-trash"></i>DELETE</button>
                                                </form>
                                            @endcan
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center">No data found..</td>
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
