<div class="section-menu-left">
    <div class="box-logo">
        <a href="index.html" id="site-logo-inner">
            <img class="" id="logo_header" alt="" src="{{ asset('assets/images/logo/logo.png') }}"
                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">{{ trans('sidebar.MainHome') }}</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="index.html" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">{{ trans('sidebar.Dashboard') }}</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="text">{{ trans('sidebar.Admins') }}</div>
                    </a>

                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('admins.index') }}" class="">
                                <div class="text">{{ trans('sidebar.ManageAdmins') }}</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('admins.create') }}" class="">
                                <div class="text">{{ trans('sidebar.AddAdmin') }}</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">{{ trans('sidebar.Roles') }}</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('roles.create') }}" class="">
                                <div class="text">{{ trans('sidebar.AddRole') }}</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('roles.index') }}" class="">
                                <div class="text">{{ trans('sidebar.RolesList') }}</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">{{ trans('vendors.Vendors') }}</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('vendors.create') }}" class="">
                                <div class="text">{{ trans('vendors.NewVendor') }}</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('vendors.index') }}" class="">
                                <div class="text">{{ trans('vendors.VendorList') }}</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">{{ trans('sidebar.Orders') }}</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="orders.html" class="">
                                <div class="text">{{ trans('sidebar.OrdersList') }}</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="order-tracking.html" class="">
                                <div class="text">{{ trans('sidebar.OrderTracking') }}</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="slider.html" class="">
                        <div class="icon"><i class="icon-image"></i></div>
                        <div class="text">{{ trans('sidebar.Slider') }}</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="coupons.html" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">{{ trans('sidebar.Coupons') }}</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="users.html" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">{{ trans('sidebar.Users') }}</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="settings.html" class="">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">{{ trans('sidebar.Settings') }}</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
