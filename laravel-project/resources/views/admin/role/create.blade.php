@extends('layouts.admin')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            Add Role
        </div>
        <div class="panel-body">
            <form action="{{ route('role.store') }}" role="form" method="POST">
                @csrf
                <div class="form-group">
                    <label>Role Name</label>
                    <input class="form-control" type="text" name="role_name">
                </div>
                <div class="form-group">
                    <label>Permissions</label> <button type="button" id="select_all" style="float: right;">Select All</button>
                    @forelse($permissions as $_permission)
                        <div class="checkbox add_attr">
                            <label>
                                <input type="checkbox" value="{{$_permission->name}}" name="permissions[]">{{$_permission->name}}
                            </label>
                        </div>
                        @empty
                        <div class="checkbox">
                            No Permission found.
                        </div>
                    @endforelse
                    
                </div>
                <button type="submit" class="btn btn-info">Save</button>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#select_all").click(function() {
            // console.log('test');
            $('.add_attr input[type="checkbox"]').attr("checked", "checked");
        });
    });
</script>


@endsection