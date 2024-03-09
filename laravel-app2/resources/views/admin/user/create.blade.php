@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Add User
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Enter Name</label>
                            <input class="form-control" type="text" name="name">
                            {{-- <p class="help-block">Help text here.</p> --}}
                        </div>
                        <div class="form-group">
                            <label>Enter Email</label>
                            <input class="form-control" type="text" name="email">
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input class="form-control" type="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-info">Save user</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
