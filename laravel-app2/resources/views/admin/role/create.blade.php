@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Add Role
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Role Name</label>
                        <input class="form-control" type="text" name="name">
                        {{-- <p class="help-block">Help text here.</p> --}}
                    </div>
                    <div class="form-group">
                        <label>Permissions</label>
                        @forelse($permissions as $permission)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $permission->name }}" name="permissions[]"> {{ $permission->name }}
                                </label>
                            </div>
                        @empty
                            <div class="checkbox">
                                No data found
                            </div>
                        @endforelse
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection