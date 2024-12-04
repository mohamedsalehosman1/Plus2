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
            <ul class="menu-list">

                <!-- Admins menu item visible only for admins -->
                @permission('create_admins', 'read_admins')
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="text">{{ trans('sidebar.Admins') }}</div>
                        </a>
                        <ul class="sub-menu">
                            @permission('read_admins')
                                <li class="sub-menu-item">
                                    <a href="{{ route('admins.index') }}" class="">
                                        <div class="text">{{ trans('sidebar.ManageAdmins') }}</div>
                                    </a>
                                </li>
                            @endpermission

                            @permission('create_admins')
                                <li class="sub-menu-item">
                                    <a href="{{ route('admins.create') }}" class="">
                                        <div class="text">{{ trans('sidebar.AddAdmin') }}</div>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission

                @permission('create_roles', 'read_roles')
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">{{ trans('sidebar.Roles') }}</div>
                        </a>
                        <ul class="sub-menu">
                            @permission('create_roles')
                                <li class="sub-menu-item">
                                    <a href="{{ route('roles.create') }}" class="">
                                        <div class="text">{{ trans('sidebar.AddRole') }}</div>
                                    </a>
                                </li>
                            @endpermission

                            @permission('read_roles')
                                <li class="sub-menu-item">
                                    <a href="{{ route('roles.index') }}" class="">
                                        <div class="text">{{ trans('sidebar.RolesList') }}</div>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission

                @permission('create_vendors', 'read_vendors')
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">{{ trans('vendors.Vendors') }}</div>
                        </a>
                        <ul class="sub-menu">
                            @permission('create_vendors')
                                <li class="sub-menu-item">
                                    <a href="{{ route('vendors.create') }}" class="">
                                        <div class="text">{{ trans('vendors.NewVendor') }}</div>
                                    </a>
                                </li>
                            @endpermission
                            @permission('read_vendors')
                                <li class="sub-menu-item">
                                    <a href="{{ route('vendors.index') }}" class="">
                                        <div class="text">{{ trans('vendors.VendorList') }}</div>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @permission('create_coupons', 'read_coupons')
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">{{ trans('coupons.Coupons') }}</div>
                        </a>
                        <ul class="sub-menu">
                            @permission('create_coupons')
                                <li class="sub-menu-item">
                                    <a href='{{ route('coupons.create') }}' class="">
                                        <div class="text">{{ trans('coupons.NewCoupon') }}</div>
                                    </a>
                                </li>
                            @endpermission
                            @permission('read_coupons')
                                <li class="sub-menu-item">
                                    <a href='{{ route('coupons.index') }}' class="">
                                        <div class="text">{{ trans('coupons.CouponList') }}</div>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
                @permission('create_ads', 'read_ads')

                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">Ads</div>
                        </a>
                        <ul class="sub-menu">
                           @permission('create_ads')
                                <li class="sub-menu-item">
                                    <a href='{{ route('ads.create') }}' class="">
                                        <div class="text">Add Ads</div>
                                    </a>
                                </li>
                            @endpermission

                            @permission('read_ads')
                                <li class="sub-menu-item">
                                    <a href='{{ route('ads.index') }}' class="">
                                        <div class="text">Ads</div>
                                    </a>
                                </li>
                            @endpermission

                        </ul>
                    </li>
                @endpermission

            </ul>
        </div>
    </div>
</div>
