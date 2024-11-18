@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    <h3>{{ trans('admins.create_admin') }}</h3>

                    <form method="POST" action="{{ route('admins.store') }}">
                        @csrf
                        <div class="form">
                            <label for="name">{{ trans('admins.admin_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('admins.admin_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('admins.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('admins.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group">
                            <label for="roles">{{ trans('admins.assign_role') }}</label>
                            <select name="roles[]" id="roles" class="form-control" multiple required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('admins.create_new_admin') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
