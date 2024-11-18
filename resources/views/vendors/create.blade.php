@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    <h3>{{ trans('vendors.create_vendor') }}</h3>

                    <form method="POST" action="{{ route('vendors.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('vendors.vendor_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('vendors.vendor_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('vendors.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('vendors.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <!-- Role Selection -->


                        <button type="submit" class="btn btn-primary">{{ trans('vendors.create_new_vendor') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
