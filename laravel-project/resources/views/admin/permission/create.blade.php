@extends('layouts.admin')

@section('content')
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Add Permission
            </div>
            <div class="panel-body">
                <form action="{{ route('permission.store') }}" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Permission Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>

                </form>
            </div>
        </div>
    </div>
@endsection
