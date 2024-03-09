@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Add Permission
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Permission Name</label>
                        <input class="form-control" type="text" name="name">
                        {{-- <p class="help-block">Help text here.</p> --}}
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection