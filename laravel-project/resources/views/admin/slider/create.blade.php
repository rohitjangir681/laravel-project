@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Add Slider
                </div>
                <div class="panel-body">
                    <form action="{{ route('slider.store') }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input class="form-control" type="text" name="title">
                            {{-- <p class="help-block">Help text here.</p> --}}
                        </div>
                        <div class="form-group">
                            <label>Enter Ordering</label>
                            <input class="form-control" type="number" name="ordering">
                            {{-- <p class="help-block">Help text here.</p> --}}
                        </div>

                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-success">
                                            <span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="image">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists"
                                            data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
