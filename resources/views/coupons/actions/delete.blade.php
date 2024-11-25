@php
$coupon_route = auth('admins')->user() ? 'coupons' : 'coupons';
@endphp
@permission('delete_coupons')
    <form action="{{ route("$coupon_route.destroy", $coupon->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endpermission
