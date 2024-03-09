@extends('layouts.admin')

@section('content')
{{-- {{$user}} --}}
<section class="content-header">
    <h1>User Profile</h1>
</section>
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Profile</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            @foreach($user as $_user)
                            @can('user_edit')
                            <a href="{{ route('user.edit', $_user->id) }}" class="btn btn-primary" style="margin-bottom:5px;">Edit user</a>
                            @endcan
                            <tr>
                                <th>Name</th>
                                <td>{{ $_user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $_user->email }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
