@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Permission List
            </div>
            <div class="panel-body">
                <a href="{{ route('permission.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add Permission</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;    
                            @endphp
                            @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-primary" style="float:left;margin-right:4px;">Edit</a>
                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td align="center" colspan="3">No Permission found.</td>
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
