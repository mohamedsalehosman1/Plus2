@php
$slug =Str::slug($coupon->code,'-');
$coupon_route = auth('admins')->user() ? 'coupons' : 'coupons';
@endphp
@permission('update_coupons')
    <a href="{{ route("$coupon_route.edit", $slug) }}" class="btn btn-warning">Edit</a>
@endpermission
