@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('vendors.show_vendor') }}</h6>

                    <div class="form-group">
                        <label for="name">{{ trans('vendors.vendor_name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $vendor->name }}"
                            required readonly>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('vendors.vendor_email') }}</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ $vendor->email }}" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('vendors.upload_image') }}</label>
                        @if($vendor->getFirstMediaUrl('images'))
                            <div>
                                <img src="{{ $vendor->getFirstMediaUrl('images') }}" alt="{{ $vendor->name }} image" class="img-fluid" width="150">
                            </div>
                        @else
                            <p>{{ trans('vendors.no_image') }}</p>
                        @endif
                    </div>

                    <!-- You can add an option to update the image if needed -->



                </div>
            </div>
        </div>
    </div>
@endsection
