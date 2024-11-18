@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('admins.soft_deleted_admins') }}</h6>

                    <!-- زر العودة إلى صفحة الأدمن الرئيسية -->
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary mb-3">{{ trans('admins.back_to_admin_list') }}</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('admins.admin_name') }}</th>
                                <th>{{ trans('admins.deleted_at') }}</th>
                                <th>{{ trans('admins.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->deleted_at }}</td> <!-- عرض تاريخ الحذف -->
                                    <td>
                                        <!-- استرجاع الـ Admin المحذوف -->
                                        <a href="{{ route('admins.restore', $admin->id) }}" class="btn btn-success btn-sm">{{ trans('admins.restore') }}</a>
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
