<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>

                <a href="{{ route('dashboard') }}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>


            <li class="treeview">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                {{-- <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> --}}
            </li>
            @can('user_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-users"></i>User list</a></li>
                        @can('user_create')
                            <li><a href="{{ route('user.create') }}"><i class="fa fa-user"></i>User Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('page_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Pages</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('page.index') }}"><i class="fa fa-square"></i>Page list</a>
                        </li>
                        @can('page_create')
                            <li><a href="{{ route('page.create') }}"><i class="fa fa-square"></i>Page Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('slider_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Slider</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('slider.index') }}"><i class="fa fa-sliders"></i>Slider
                                list</a></li>
                        @can('slider_create')
                            <li><a href="{{ route('slider.create') }}"><i class="fa fa-sliders"></i>Slider Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('block_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Block</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('block.index') }}"><i class="fa fa-block"></i>Block list</a>
                        </li>
                        @can('block_create')
                            <li><a href="{{ route('block.create') }}"><i class="fa fa-square"></i>Block Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('manage_roles')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Roles</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('role.index') }}"><i class="fa fa-tasks"
                                    aria-hidden="true"></i> Role list</a></li>
                        <li><a href="{{ route('role.create') }}"><i class="fa fa-tasks"></i>Role Add</a></li>
                    </ul>
                </li>
            @endcan

            @can('manage_permissions')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-circle-o"></i> <span>Manage Permissions</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('permission.index') }}"><i class="fa fa-lock"></i>Permission
                                list</a></li>
                        <li><a href="{{ route('permission.create') }}"><i class="fa fa-unlock"></i>Permission Add</a></li>
                    </ul>
                </li>
            @endcan


            {{-- Products section start --}}
            @can('product_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-product-hunt"></i> <span>Manage Products</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('product.index') }}"><i class="fa fa-list"
                                    aria-hidden="true"></i> Product list</a></li>
                        @can('product_create')
                            <li><a href="{{ route('product.create') }}"><i class="fa fa-product-hunt"></i>Product Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            {{-- Products section end --}}


            {{-- Category section start --}}
            @can('category_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-list"></i> <span>Manage Categories</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('category.index') }}"><i class="fa fa-list"
                                    aria-hidden="true"></i> Category list</a></li>
                        @can('category_create')
                            <li><a href="{{ route('category.create') }}"><i class="fa fa-list"></i>Category Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            {{-- Category section end --}}

            {{-- Attribute section start --}}
            @can('attribute_index')
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-list"></i> <span>Manage Attributes</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('attribute.index') }}"><i class="fa fa-list"
                                    aria-hidden="true"></i> Attribute list</a></li>
                        @can('attribute_create')
                            <li><a href="{{ route('attribute.create') }}"><i class="fa fa-list"></i>Attribute Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            {{-- Attribute section end --}}

            

            <!---- Attribute section start -->
            @can('coupon_index')
            <li class="treeview">
                <a href="">
                    <i class="fa fa-gift"></i> <span>Manage Coupons</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('coupon.index') }}"><i class="fa fa-gift"
                                aria-hidden="true"></i>Coupons List</a></li>
                                @can('coupon_create')
                    <li><a href="{{ route('coupon.create') }}"><i class="fa fa-gift"></i>Add Coupons</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            <!-- Attribute section end -->


            <!---- Manage orders section start -->
            @can('manage_orders')
            <li class="treeview">
                <a href="{{ route('manage.orders') }}">
                    <i class="fa fa-first-order"></i> <span>Manage orders</span>
                </a>
            </li>
            @endcan
            <!-- Manage orders section end -->


              <!---- Manage customer section start -->
              @can('manage_customers')
              <li class="treeview">
                  <a href="{{ route('manage.customers') }}">
                      <i class="fa fa-first-order"></i> <span>Manage customer</span>
                  </a>
              </li>
              @endcan
              <!-- Manage customer section end -->
              
            @can('enquiry')
                <li class="treeview">
                    <a href="{{ route('enquiries') }}">
                        <i class="fa fa-circle-o"></i> <span>Manage Enquiry</span>
                    </a>
                </li>
            @endcan

            <li class="treeview">
                <a href="{{ route('user.show', auth()->user()->id) }}">
                    <i class="fa fa-user"></i> <span>Profile</span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


 
 
 
 
