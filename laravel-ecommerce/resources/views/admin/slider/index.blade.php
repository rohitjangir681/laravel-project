@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Slider List</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Slider List</h3>
                        <a href="{{ route('slider.create') }}" class="btn btn-primary" style="float: right;">Slider Add</a>
                        @if(session()->has('success'))
                            <div class="callout callout-success" style="margin-top:20px;">{{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Ordering</th>
                                <th>Status</th>
                                <th>Image</th>
                                @if(Gate::allows('slider_edit') or Gate::allows('slider_delete'))
                                <th>Action</th>
                                @endif
                            </tr>
                            @php
                                $i=1;
                            @endphp
                            @forelse($sliders as $slider)
                            <tr>
                                <td>{{ $i++ . '.' }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->ordering }}</td>
                                <td>{{ ($slider->status==1) ? 'Enable': 'Disable' }}</td>
                                <td style="width: 150px;"><img src="{{ $slider->getFirstMediaUrl('image') }}" alt="" style="width:100%;"></td>
                                @if(Gate::allows('slider_edit') or Gate::allows('slider_delete'))
                                <td>
                                    @can('slider_edit')
                                    <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary" style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                    @endcan
                                    @can('slider_delete')
                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>DELETE</button>
                                    </form>
                                    @endcan
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" align="center">No data found.</td>
                            </tr>
                            @endforelse

                        </table>
                    </div><!-- /.box-body -->    
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
