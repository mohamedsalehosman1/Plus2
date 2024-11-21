@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">


                <div class="wg-box">
                    <h3>{{ trans('admins.create_admin') }}</h3>

                    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <label for="name">{{ trans('admins.admin_name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control">

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('admins.admin_email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control">

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('admins.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('admins.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>


                        <label for="roles">{{ trans('admins.assign_role') }}</label>
                        <select name="roles[]" id="roles" class="form-select">
                            <option value="" selected disabled>----choose roles---</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="image">{{ trans('admins.upload_image') }}</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>


                <button type="submit" class="btn btn-primary">{{ trans('admins.create_new_admin') }}</button>
                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
