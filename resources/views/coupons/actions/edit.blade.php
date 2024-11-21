@php
$coupon_route = auth('admins')->user() ? 'coupons' : 'vendors.coupons';
@endphp
@permission('update_coupons')
    <a href="{{ route("$coupon_route.edit", $coupon->id) }}" class="btn btn-warning">Edit</a>
@endpermission
