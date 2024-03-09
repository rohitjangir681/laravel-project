<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <div class="user-img-div">
                    <img src="{{ asset('assets/img/user.png') }}" class="img-thumbnail" />

                    <div class="inner-text">
                        {{ auth()->user()->name }}
                        <br />
                        <small>Last Login : 2 Weeks Ago </small>
                    </div>
                </div>

            </li>


            <li>
                <a class="active-menu" href="{{ route('dashboard') }}"><i class="fa fa-dashboard "></i>Dashboard</a>
            </li>


            @can('user_index')
                <li>
                    <a href="#"><i class="fa fa-desktop "></i>Manage Users <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('user.index') }}"><i class="fa fa-users"></i>User List</a>
                        </li>

                        @can('user_create')
                            <li>
                                <a href="{{ route('user.create') }}"><i class="fa fa-user"></i>Add User</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan


            @can('slider_index')
                <li>
                    <a href="#"><i class="fa fa-desktop "></i>Manage Sliders<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('slider.index') }}"><i class="fa fa-sliders"></i>Slider List</a>
                        </li>

                        @can('slider_create')
                            <li>
                                <a href="{{ route('slider.create') }}"><i class="fa fa-sliders"></i>Add Slider</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('page_index')
                <li>
                    <a href="#"><i class="fa fa-desktop "></i>Manage Pages<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('page.index') }}"><i class="fa fa-toggle-on"></i>Page List</a>
                        </li>

                        @can('page_create')
                            <li>
                                <a href="{{ route('page.create') }}"><i class="fa fa-toggle-on"></i>Add Page</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('block_index')
                <li>
                    <a href="#"><i class="fa fa-desktop "></i>Manage Block<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('block.index') }}"><i class="fa fa-toggle-on"></i>Block List</a>
                        </li>

                        @can('block_create')
                            <li>
                                <a href="{{ route('block.create') }}"><i class="fa fa-toggle-on"></i>Add Block</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('enquiry_list')
                <li>
                    <a href="{{ route('enquirie') }}"><i class="fa fa-flash "></i>Manage Enquiry</a>
                </li>
            @endcan

            @can('manage_roles')
                <li>
                    <a href="#"><i class="fa fa-bicycle"></i>Manage Roles<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('role.index') }}"><i class="fa fa-toggle-on"></i>Role List</a>
                        </li>
                        <li>
                            <a href="{{ route('role.create') }}"><i class="fa fa-toggle-on"></i>Add Role</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('manage_permissions')
                <li>
                    <a href="#"><i class="fa fa-bicycle"></i>Manage Permissions<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('permission.index') }}"><i class="fa fa-toggle-on"></i>Permissions List</a>
                        </li>
                        <li>
                            <a href="{{ route('permission.create') }}"><i class="fa fa-toggle-on"></i>Add Permissions</a>
                        </li>
                    </ul>
                </li>
            @endcan

        </ul>

    </div>

</nav>
