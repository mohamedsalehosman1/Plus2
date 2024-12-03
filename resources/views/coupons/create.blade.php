@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('coupons.AddNewCoupon') }}</h2>

                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="code">{{ trans('coupons.CouponCode') }}:</label>
                        <input type="text" name="code" value="{{ old('code') }}" id="code" class="form-control">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount_percent">{{ trans('coupons.DiscountPercent') }}:</label>
                        <input type="number" name="discount_percent" value="{{ old('discount_percent') }}"
                            id="discount_percent" class="form-control">
                        @error('discount_percent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_discount">{{ trans('coupons.MaxDiscount') }}:</label>
                        <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount') }}"
                            class="form-control">
                        @error('max_discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start_at">{{ trans('coupons.StartDate') }}:</label>
                        <input type="date" name="start_at" id="start_at" value="{{ old('start_at') }}"
                            class="form-control">
                        @error('start_at')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_at">{{ trans('coupons.EndDate') }}:</label>
                        <input type="date" name="end_at" id="end_at" value="{{ old('end_at') }}"
                            class="form-control">
                        @error('end_at')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_use">{{ trans('coupons.max_use') }}:</label>
                        <input type="number" name="max_use" value="{{ old('max_use') }}" id="max_use"
                            class="form-control">
                        @error('max_use')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_use_per_user">{{ trans('coupons.max_use_per_user') }}:</label>
                        <input type="number" name="max_use_per_user" value="{{ old('max_use_per_user') }}"
                            id="max_use_per_user" class="form-control">
                        @error('max_use_per_user')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (!auth('vendors')->check()) 
                        <div class="form-group">
                            <label for="vendor_id">{{ trans('coupons.Vendor') }}:</label>
                            <select name="vendor_id" id="vendor_id" class="form-control" required>
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <!-- إذا كان المستخدم هو vendor، يتم تمرير القيمة المخفية -->
                        <input type="hidden" name="vendor_id" value="{{ auth('vendors')->user()->id }}">
                    @endif

                    <button type="submit" class="btn btn-primary">{{ trans('coupons.AddCoupon') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
