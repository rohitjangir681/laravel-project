@extends('layouts.admin')

@section('content')
{{-- {{ $block }} --}}
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Edit Block
                </div>
                <div class="panel-body">
                    <form action="{{ route('block.update', $block->id) }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $block->title }}">
                        </div>
                        <div class="form-group">
                            <label>Enter Identifier</label>
                            <input class="form-control" type="text" name="identifier" value="{{ $block->identifier }}">
                        </div>
                        
                        <div class="form-group">
                            <label>Enter Heading</label>
                            <input class="form-control" type="text" name="heading" value="{{ $block->heading }}">
                        </div>
                        <div class="form-group">
                            <label>Enter Ordering</label>
                            <input class="form-control" type="number" name="ordering" value="{{ $block->ordering }}">
                        </div>
                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ ($block->status=='1') ? 'selected': '' }}>Enable</option>
                                <option value="2" {{ ($block->status=='2') ? 'selected': '' }}>Disable</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Enter Description</label>
                            <textarea class="form-control" rows="3" name="description" id="editor">{{ $block->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{ $block->getFirstMediaUrl('image') }}">
                                    </div>
                                    <div>
                                        <span class="btn btn-file btn-success">
                                            <span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="image" value="{{ $block->getFirstMediaUrl('image') }}">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists"
                                            data-dismiss="fileupload">Remove</a>
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
