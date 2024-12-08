@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('vendors.soft_deleted_vendors') }}</h6>

                    <!-- زر العودة إلى صفحة البائعين الرئيسية -->
                    <a href="{{ route('vendors.index') }}"
                        class="btn btn-secondary mb-3">{{ trans('vendors.back_to_vendor_list') }}</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif


                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('vendors.vendor_name') }}</th>
                                <th>{{ trans('vendors.deleted_at') }}</th>
                                <th>{{ trans('vendors.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->deleted_at }}</td> <!-- عرض تاريخ الحذف -->
                                    <td>
                                        <!-- استرجاع البائع المحذوف -->
                                        <a href="{{ route('vendors.restore', $vendor->id) }}"
                                            class="btn btn-success btn-sm">{{ trans('vendors.restore') }}</a>

                                        <!-- زر الحذف النهائي -->
                                        <form action="{{ route('vendors.forcedelete', $vendor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ trans('vendors.are_you_sure') }}');">
                                                {{ trans('vendors.delete_permanently') }}
                                            </button>
                                        </form>

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
