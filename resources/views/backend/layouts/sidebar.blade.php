<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
{{--        <a class="desktop-logo logo-light active" href="@if(auth()->user()->role == 'admin') {{route('admin_dashboard')}} @else {{route('school_dashboard')}}  @endif"><img src="{{asset('logo/logo2.png')}}" class="main-logo" alt="logo"></a>--}}
{{--        <a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="{{asset('backend/assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>--}}
        <center>
            <h5>Push Notification</h5>
        </center>

    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{auth()->user()->image}}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>

                    @if(auth()->user()->role == 'admin')
                        <span class="mb-0 text-muted">Admin Panel</span>
                    @else
                        <span class="mb-0 text-muted">School Panel</span>
                    @endif
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>

            @if(auth()->user()->role == 'admin')


                <li class="slide">
                    <a class="side-menu__item" href="{{route('admin_dashboard')}}">

                        <span class="side-menu__icon " >
                            <i class="las la-home"></i>
                        </span>

                        <span class="side-menu__label" style="margin-top: 5%">
                            Push Notification
                        </span>
                    </a>
                </li>

            @endif


        </ul>
    </div>
</aside>
<!-- main-sidebar -->
