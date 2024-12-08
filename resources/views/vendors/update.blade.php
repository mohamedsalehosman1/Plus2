@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('vendors.edit_vendor') }}</h6>

                    <form method="POST" action="{{ route('vendors.update', $vendor->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ trans('vendors.vendor_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $vendor->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('vendors.vendor_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $vendor->email }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('vendors.password') }}
                                ({{ trans('vendors.leave_blank_for_current_password') }})</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('vendors.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>

                        <!-- خدمة البائع (خدمات متعددة) -->
                        <div class="form-group">
                            <label for="services">{{ trans('vendors.select_services') }}</label>
                            <select name="services[]" id="services" class="form-control" multiple>
                                @foreach ($services as $service)
                                    <!-- عرض الخدمة الأم -->
                                    <option value="{{ $service->id }}"
                                        @if($vendor->services && in_array($service->id, $vendor->services->pluck('id')->toArray())) selected @endif>
                                        {{ $service->name }}
                                    </option>

                                    <!-- عرض الأبناء مع مسافة بادئة -->
                                    @foreach ($service->children as $childService)
                                        <option value="{{ $childService->id }}"
                                            @if($vendor->services && in_array($childService->id, $vendor->services->pluck('id')->toArray())) selected @endif>
                                            &nbsp;&nbsp;&raquo; {{ $childService->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>

                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- رفع الصورة -->
                        <div class="form-group">
                            <label for="image">{{ trans('admins.upload_image') }}</label>
                            <input type="file" name="image" id="image" class="form-control dropify"
                                accept="image/*" data-default-file="{{ $vendor->getFirstMediaUrl('images') }}"
                                data-allowed-file-extensions="png jpg jpeg">
                        </div>

                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">{{ trans('vendors.update_vendor') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
