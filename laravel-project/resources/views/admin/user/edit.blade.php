@extends('layouts.admin')

@section('content')
{{-- {{ $user_role }}
{{ die() }} --}}
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-info">
             <div class="panel-heading">
                Edit User
             </div>
             <div class="panel-body">
                 <form action="{{ route('user.update', $user->id) }}" role="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                        @error('name')
                            <p class="help-block alert alert-danger" style="padding:6px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
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
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ (in_array($role->name, $user_role)) ? 'checked':'' }}>{{ $role->name }}
                                {{-- {{ in_array($role->name, $user_role) }} --}}
                            </label>
                        </div>
                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-info">Update</button>

                 </form>
            </div>
    </div>
</div>
@endsection