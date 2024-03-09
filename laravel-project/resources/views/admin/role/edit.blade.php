@extends('layouts.admin')

@section('content')
{{-- {{ $perName }} --}}
{{-- 

    // Use of toArray() function in php
@php
    $collection = collect(['name' => 'Desk', 'price' => 200]);
print_r($collection);
echo "<br><br>";
    $test = $collection->toArray();
    print_r($test);
@endphp --}}


<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            Edit Role
        </div>
        <div class="panel-body">
            <form action="{{ route('role.update', $roleData->id) }}" role="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Role Name</label>
                    <input class="form-control" type="text" name="role_name" value="{{ $roleData->name }}">
                </div>

                <div class="form-group">
                    <label>Permissions</label><button type="button" id="select_all" style="float: right;">Select All</button>
                    @forelse($permissions as $permission)
                        <div class="checkbox add_attr">
                            <label>
                                <input type="checkbox" value="{{ $permission->name }}" name="permissions[]" {{ (in_array($permission->name, $perName) ? 'checked': '') }}>{{ $permission->name }}
                            </label>
                        </div>
                        @empty
                        <div class="checkbox">
                            No Permission found.
                        </div>
                    @endforelse
                </div>

                <button type="submit" class="btn btn-info">Update</button>

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