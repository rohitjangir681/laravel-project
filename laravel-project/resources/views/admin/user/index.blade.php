@extends('layouts.admin')
@section('content')
<div class="row">
    {{-- {{ $userData }} --}}
    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel panel-info">
                <div class="panel-heading">
                    User List
                </div>
                <div class="panel-body">
                    @can('user_create')
                        <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add User</a>
                    @endcan
                    <div class="table-responsive">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <td>Role</td>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp

                                @forelse($userData as $_userData)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $_userData->name }}</td>
                                        <td>{{ $_userData->email }}</td>
                                        <td>{{ implode(',', $_userData->roles->pluck('name')->toArray()) }}</td>
                                        <td>
                                            @can('user_edit')
                                                <a href="{{ route('user.edit', $_userData->id) }}" class="btn btn-primary" style="float: left;margin-right:4px;"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                                            @endcan
                                            @can('user_delete')
                                                <form action="{{ route('user.destroy', $_userData->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-primary" align="center" colspan="4">No found data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End  Kitchen Sink -->
        </div>
    </div>
</div>
@endsection