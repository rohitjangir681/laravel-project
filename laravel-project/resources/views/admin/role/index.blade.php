@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Role List
            </div>
            <div class="panel-body">
                <a href="{{ route('role.create') }}" class="btn btn-primary" style="margin-bottom:12px;">Add Role</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $i++ . '.' }}</td>
                                <td>{{ $role->name }}</td>

                                    {{-- <td> // Just for learning, i have saved it here
                                        @php
                                            echo "<pre>";
                                            print_r($role->permissions->pluck('name')->toArray());
                                        @endphp
                                    </td> --}}


                                <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary" style="float:left;margin-right:4px;">Edit</a>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td align="center" colspan="4">No Role found</td>
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



