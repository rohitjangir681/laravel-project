@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Block Add</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Block Add</h3>
                        <a href="{{ route('block.index') }}" class="btn btn-primary" style="float: right;">Block list</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('block.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <label for="exampleInputTitle">Enter title</label>
                            <div class="form-group @error('title') has-error @enderror">
                                <input type="text" name="title" class="form-control" id="exampleInputTitle"
                                    placeholder="Enter title" value="{{ old('title') }}">
                                @error('title')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>
                            <label for="exampleInputHeading">Enter Heading</label>
                            <div class="form-group @error('heading') has-error @enderror">
                                <input type="text" name="heading" class="form-control" id="exampleInputHeading"
                                    placeholder="Enter heading" value="{{ old('heading') }}">
                                @error('heading')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>


                            <label for="exampleInputOrdering">Enter Ordering</label>
                            <div class="form-group @error('ordering') has-error @enderror">
                                <input type="number" name="ordering" class="form-control" id="exampleInputOrdering"
                                    placeholder="Enter ordering" value="{{ old('ordering') }}">
                                @error('ordering')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIdentifier">Enter Identifier</label>
                                <input type="text" name="identifier" class="form-control" id="exampleInputIdentifier"
                                    placeholder="Enter identifier">
                            </div>
                            <label>Select Status</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ (old('status')==1) ? 'selected': '' }}>Enable</option>
                                    <option value="2" {{ (old('status')==2) ? 'selected': '' }}>Disable</option>
                                </select>
                                @error('status')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>


                            <label for="editor">Enter Description</label>
                            <div class="form-group">
                                <textarea name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Upload image</label>
                                <input type="file" name="image" id="exampleInputFile">
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
