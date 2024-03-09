@extends('layouts.admin')
{{-- {{ $data }} --}}

{{-- <img src="{{ $data->getFirstMediaUrl('image') }}" alt="" style="width: 200px;"> --}}


@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Edit Slider
                </div>
                <div class="panel-body">
                    <form action="{{ route('slider.update', $data->id) }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $data->title }}">
                            {{-- <p class="help-block">Help text here.</p> --}}
                        </div>
                        <div class="form-group">
                            <label>Enter Ordering</label>
                            <input class="form-control" type="number" name="ordering" value="{{ $data->ordering }}">
                            {{-- <p class="help-block">Help text here.</p> --}}
                        </div>

                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ ($data->status=='1') ? 'selected':'' }}>Enable</option>
                                <option value="2" {{ ($data->status=='2') ? 'selected':'' }}>Disable</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{ $data->getFirstMediaUrl('image') }}" alt="">
                                    </div>
                                    <div>
                                        <span class="btn btn-file btn-success">
                                            <span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="image" value="{{ $data->getFirstMediaUrl('image') }}">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
