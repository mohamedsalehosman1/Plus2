@extends('layouts.master')

@section('content')
    <div class="main-content">

        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('admins.show_admin') }}</h6>

                    <div class="form-group">
                        <label for="name">{{ trans('admins.admin_name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('admins.admin_email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('admins.password') }} ({{ trans('admins.leave_blank_for_current_password') }})</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('admins.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
