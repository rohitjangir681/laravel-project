@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>Slider Add</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Slider Add</h3>
                        <a href="{{ route('slider.index') }}" type="button" class="btn btn-primary"
                            style="float: right;">Slider List</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <label for="exampleInputTitle">Enter title</label>
                            <div class="form-group @error('title') has-error @enderror">
                                <input type="text" class="form-control" name="title" id="exampleInputTitle"
                                    placeholder="Enter title" value="{{ old('title') }}">
                                @error('title')
                                    <label class="control-label" for="exampleInputName"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="exampleInputOrdering">Enter ordering</label>
                            <div class="form-group @error('ordering') has-error @enderror">
                                <input type="number" name="ordering" class="form-control" id="exampleInputOrdering"
                                    placeholder="Enter ordering" value="{{ old('ordering') }}">
                                @error('ordering')
                                <label class="control-label" for="exampleInputName"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>

                            <label>Select status</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select name="status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="1" {{ (old('status')==1) ? 'selected':'' }}>Enable</option>
                                    <option value="2" {{ (old('status')==2) ? 'selected':'' }}>Disable</option>
                                </select>
                                @error('status')
                                <label class="control-label" for="exampleInputName"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Upload image</label>
                                <input type="file" id="exampleInputFile" name="image">
                                {{-- <p class="help-block">Example block-level help text here.</p> --}}
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
