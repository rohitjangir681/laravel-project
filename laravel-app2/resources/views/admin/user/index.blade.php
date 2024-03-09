@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-9">
      <!--   Kitchen Sink -->
        <div class="panel panel-default">
            <div class="panel-heading">
                User List
            </div>
            <div class="panel-body">
                <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add User</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i=1;
                            @endphp
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $i++ . '.' }}</td>
                                <td>{{ $user->name }}</td>
                                <td> {{ $user->email }} </td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" style="float:left;margin-right:4px;">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td align="center" colspan="4">No user found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection