@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ url('dashboard') }}">
                                <div class="text-tiny">Ads</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Ads_List</div>
                        </li>
                    </ul>
                </div>
                <h2>{{ trans('services.AdsList') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('services.Name') }}</th>
                            <th>{{ trans('services.Image') }}</th>
                            <th>{{ trans('services.Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sub_service as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>

                                <td>
                                    @if($service->hasMedia('images'))
                                        <img src="{{ $service->getFirstMediaUrl('images') }}" alt="Ad Image" width="50" height="50">
                                    @else
                                        {{ trans('services.NoImage') }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning" title="{{ trans('services.Edit') }}">
                                        <i class="fa fa-edit"></i> Edit_Service
                                    </a>

                                    <a href="{{ route('services.create', ['parentId' => $service->id]) }}" class="btn btn-sm btn-primary" title="{{ trans('services.AddSubService') }}">
                                        <i class="fa fa-plus"></i> Add_Sub_Services
                                    </a>

                                    <!-- Show button with eye icon -->
                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-info" title="{{ trans('services.Show') }}">
                                        <i class="fa fa-eye"></i> Show_Sub_Services
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
