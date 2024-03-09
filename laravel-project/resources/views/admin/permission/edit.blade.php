@extends('layouts.admin')

@section('content')
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Edit Permission
            </div>
            <div class="panel-body">
                <form action="{{ route('permission.update', $data->id) }}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Permission Name</label>
                        <input class="form-control" type="text" name="name" value="{{ $data->name }}">
                    </div>
                    <button type="submit" class="btn btn-info">Update</button>

                </form>
            </div>
        </div>
    </div>
@endsection
