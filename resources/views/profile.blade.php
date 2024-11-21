@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    @if (auth()->guard('admins')->check())
                        @php
                            $admin = auth()->guard('admins')->user();
                            $adminImageUrl = $admin->getFirstMediaUrl('images');
                        @endphp

                        <h2>مرحباً، {{ $admin->name }}!</h2>

                        @if ($adminImageUrl)
                            <img id="current-image" src="{{ $adminImageUrl }}" alt="Admin image"
                                style="max-width: 200px; max-height: 200px; object-fit: cover;" />
                        @else
                            <p>لا توجد صورة للملف الشخصي</p>
                        @endif

                        <form id="profile-form" action="{{ route('admin.updateProfile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <label for="name">الاسم</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required>

                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>

                            <div class="form-group">
                                <label for="password">كلمة المرور (اتركها فارغة إذا كنت لا ترغب في تغييرها)</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="form-group">
                                <label for="roles">{{ trans('admins.assign_role') }}</label>
                                <select name="roles[]" id="roles" class="form-select">
                                    <option value="" disabled>---- Choose Role ----</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if ($admin->hasRole($role->name)) selected @endif>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">{{ trans('admins.upload_image') }}</label>
                                <input type="file" name="image" id="image" class="form-control dropify"
                                    accept="image/*" data-default-file="{{ $adminImageUrl }}">
                            </div>

                            <button type="submit">تحديث البيانات</button>
                        </form>
                    @elseif(auth()->guard('vendors')->check())
                        @php
                            $vendor = auth()->guard('vendors')->user();
                            $vendorImageUrl = $vendor->getFirstMediaUrl('images');
                        @endphp

                        <h2>مرحباً، {{ $vendor->name }}!</h2>

                        @if ($vendorImageUrl)
                            <img id="current-image" src="{{ $vendorImageUrl }}" alt="Vendor image"
                                style="max-width: 200px; max-height: 200px; object-fit: cover;" />
                        @else
                            <p>لا توجد صورة للملف الشخصي</p>
                        @endif

                        <form id="profile-form" action="{{ route('vendors.updateProfile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <label for="name">الاسم</label>
                            <input type="text" name="name" value="{{ old('name', $vendor->name) }}" required>

                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $vendor->email) }}" required>

                            <div class="form-group">
                                <label for="password">{{ trans('vendors.password') }}
                                    ({{ trans('vendors.leave_blank_for_current_password') }})</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ trans('vendors.confirm_password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" value="{{ old('password_confirmation') }}">
                            </div>

                            <div class="form-group">
                                <label for="image">{{ trans('admins.upload_image') }}</label>
                                <input type="file" name="image" id="image" class="form-control dropify"
                                    accept="image/*" data-default-file="{{ $vendorImageUrl }}"
                                    data-allowed-file-extensions="pdf png">
                            </div>

                            <button type="submit">تحديث البيانات</button>
                        </form>
                    @else
                        <p>لم تقم بتسجيل الدخول بعد.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>




@endsection
