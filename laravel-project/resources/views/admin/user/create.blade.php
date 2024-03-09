@extends('layouts.admin')

@section('content')

{{-- {{ $roles }} --}}

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Add User
            </div>
            <div class="panel-body">
                <form action="{{ route('user.store') }}" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="help-block alert alert-danger" style="padding:6px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="help-block alert alert-danger" style="padding:6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Enter Password</label>
                        <input class="form-control" type="password" name="password">
                        @error('password')
                            <p class="help-block alert alert-danger" style="padding:6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Enter Confirm Password</label>
                        <input class="form-control" type="password" name="confirm_password">

                        @error('confirm_password')
                            <p class="help-block alert alert-danger" style="padding:6px;">{{ $message }}</p>
                        @enderror

                        {{-- @if ($errors->has('confirm_password'))
                            <p class="help-block alert alert-danger">{{ $errors->first('confirm_password') }}</p>                            
                        @endif --}}

                    </div>

                    <div class="form-group">
                        <label>Roles</label>

                        @foreach($roles as $role)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}">{{ $role->name }}
                            </label>
                        </div>
                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-info">Save</button>

                </form>
            </div>
        </div>
    </div>
@endsection
