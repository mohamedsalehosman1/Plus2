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
                            required disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('admins.admin_email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}"
                            required disabled>
                    </div>


                    <div class="form-group">
                        <label for="role">{{ trans('admins.admin_role') }}</label>
                        <input type="text" name="role" id="role" class="form-control" value="{{ $admin->roles->pluck('name')->implode(', ') }}"
                            required disabled>
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('admins.upload_image') }}</label>
                        @if($admin->getFirstMediaUrl('images'))
                            <img src="{{ $admin->getFirstMediaUrl('images') }}" alt="{{ $admin->name }} image" class="img-fluid" width="150">
                        @else
                            <p>{{ trans('admins.no_image') }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
