@extends('layouts.master')

@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="tf-section mb-10">

            <div class="wg-box">
                <h6>{{ trans('vendors.VendorList') }}</h6>

                <a href="{{ route('vendors.trash') }}" class="btn btn-secondary mb-3">{{ trans('vendors.view_soft_deleted_vendors') }}</a>

                <a href="{{ route('vendors.create') }}" class="btn btn-primary mb-3">{{ trans('vendors.create_new_vendor') }}</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ trans('vendors.vendor_name') }}</th>
                            <th>{{ trans('vendors.vendor_email') }}</th>
                            <th>{{ trans('vendors.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>
                                    @include('vendors.actions.edit')
                                    @include('vendors.actions.delete')
                                    @include('vendors.actions.show')

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
