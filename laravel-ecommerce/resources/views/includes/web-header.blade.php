<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(Auth::user())
                        <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>
                       
                        @else
                        <a class="dropdown-item" href="{{ route('customer.create') }}">Sign Up</a>
                        <a class="dropdown-item" href="{{ route('customer.login') }}">Sign In</a>
                        @endif
                    </div>
                </div>
                
                
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Demo</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Website</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
         
        </div>
        <div class="col-lg-4 col-6 text-right">
            
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->

{{-- {{ getCategoryHomePage() }} --}}