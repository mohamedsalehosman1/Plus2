@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>{{ trans('coupons.CouponsList') }}</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ url('dashboard') }}">
                                <div class="text-tiny">Coupons</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Coupons_List</div>
                        </li>
                    </ul>
                </div>
                <h2>{{ trans('coupons.CouponsList') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
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
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                                    @include('coupons.actions.edit')
                                    @include('coupons.actions.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($coupons->isEmpty())
                    <p>{{ trans('coupons.NoCouponsFound') }}</p>
                @endif

                @if (auth('admins')->check() || auth('vendors')->check())
                    <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                        {{ trans('coupons.AddNewCoupon') }}
                    </a>
                @endif

                {{-- @if (auth('vendors')->check())
                    <a href="{{ route('coupons.index', ['vendor_id' => auth('vendors')->user()->id]) }}" class="btn btn-info mt-3">
                        {{ trans('coupons.ViewMyCoupons') }}
                    </a>
                @endif --}}
            </div>
        </div>
    </div>
@endsection
