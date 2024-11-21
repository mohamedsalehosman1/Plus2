@permission('show_coupons')
    <a href="{{ route('coupons.show', $coupon->id) }}" class="btn btn-success">Show</a>
@endpermission
