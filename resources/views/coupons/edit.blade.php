@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('coupons.EditCoupon') }}</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route("coupons.update", $coupon->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="code">{{ trans('coupons.CouponCode') }}</label>
                        <input type="text" id="code" name="code" class="form-control"
                            value="{{ old('code', $coupon->code) }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="discount_percent">{{ trans('coupons.DiscountPercent') }}</label>
                        <input type="number" id="discount_percent" name="discount_percent" class="form-control"
                            value="{{ old('discount_percent', $coupon->discount_percent) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="max_discount">{{ trans('coupons.MaxDiscount') }}</label>
                        <input type="number" id="max_discount" name="max_discount" class="form-control"
                            value="{{ old('max_discount', $coupon->max_discount) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="max_discount">{{ trans('coupons.Max_use') }}</label>
                        <input type="number" id="max_use" name="max_use" class="form-control"
                            value="{{ old('max_use', $coupon->max_use) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="max_discount">{{ trans('coupons.Max_use_per_user') }}</label>
                        <input type="number" id="max_use_per_user" name="max_use_per_user" class="form-control"
                            value="{{ old('max_use_per_user', $coupon->max_use_per_user) }}" required>
                    </div>


                    <div class="form-group">
                        <label for="start_at">{{ trans('coupons.StartDate') }}</label>
                        <input type="date" id="start_at" name="start_at" class="form-control"
                            value="{{ old('start_at', $coupon->start_at->format('Y-m-d')) }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="end_at">{{ trans('coupons.EndDate') }}</label>
                        <input type="date" id="end_at" name="end_at" class="form-control"
                            value="{{ old('end_at', $coupon->end_at->format('Y-m-d')) }}" required>
                    </div>



                    <div class="form-group">
                        <label for="vendor_id">{{ trans('coupons.Vendor') }}</label>
                        <select id="vendor_id" name="vendor_id" class="form-control" disabled>
                             @if (isset($vendors))
                             {{-- @each($vendors) --}}
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}" {{ $id == $coupon->vendor_id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                             @endif

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('coupons.UpdateCoupon') }}</button>
                    <a href="{{ route("coupons.index") }}"
                        class="btn btn-secondary">{{ trans('coupons.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
