@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('coupons.CouponsList') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('coupons.CouponCode') }}</th>
                            <th>{{ trans('coupons.DiscountPercent') }}</th>
                            <th>{{ trans('coupons.MaxDiscount') }}</th>
                            <th>{{ trans('coupons.Max_use') }}</th>
                            <th>{{ trans('coupons.Max_use_per_user') }}</th>
                            <th>{{ trans('coupons.StartDate') }}</th>
                            <th>{{ trans('coupons.EndDate') }}</th>
                            <th>{{ trans('coupons.is_active') }}</th>
                            <th>{{ trans('coupons.Vendor') }}</th>
                            <th>{{ trans('coupons.Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($coupons as $coupon)
                            @if (auth('admins')->check() || (auth('vendors')->check() && auth('vendors')->user()->id == $coupon->vendor_id))
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount_percent }}%</td>
                                    <td>{{ $coupon->max_discount }}</td>
                                    <td>{{ $coupon->max_use }}</td>
                                    <td>{{ $coupon->max_use_per_user }}</td>
                                    <td>{{ $coupon->start_at->format('Y-m-d') }}</td>
                                    <td>{{ $coupon->end_at->format('Y-m-d') }}</td>

                                    <td>
                                        <form action="{{ route('coupons.updateStatus', $coupon->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" {{ $coupon->is_active ? 'checked' : '' }}
                                                    onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>

                                    <td>{{ $coupon->vendor->name }}</td>
                                    <td>
                                        @if (auth('admins')->check() || (auth('vendors')->check() && auth('vendors')->user()->id == $coupon->vendor_id))
                                            @include('coupons.actions.edit')
                                            @include('coupons.actions.delete')
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                @php
                    $coupon_route = auth('admins')->user() ? 'coupons' : 'vendors.coupons';
                @endphp

                @if ($coupons->isEmpty())
                    <p>{{ trans('coupons.NoCouponsFound') }}</p>
                @endif

                @if (auth('admins')->check() || auth('vendors')->check())
                    <a href="{{ route("$coupon_route.create") }}" class="btn btn-primary">
                        {{ trans('coupons.AddNewCoupon') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
