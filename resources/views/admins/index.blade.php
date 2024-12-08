@extends('layouts.master')

@section('content')
    <div class="main-content">

        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('admins.admin_list') }}</h6>

                    <a href="{{ route('admins.trash') }}"
                        class="btn btn-secondary mb-3">{{ trans('admins.view_soft_deleted_admins') }}</a>

                    <a href="{{ route('admins.create') }}"
                        class="btn btn-primary mb-3">{{ trans('admins.create_new_admin') }}</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('admins.admin_name') }}</th>
                                <th>{{ trans('admins.admin_email') }}</th>
                                <th>{{ trans('admins.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @include('admins.actions.edit')
                                        @include('admins.actions.delete')
                                        @include('admins.actions.show')
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
