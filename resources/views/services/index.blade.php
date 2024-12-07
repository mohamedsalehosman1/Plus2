@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ url('dashboard') }}">
                                <div class="text-tiny">Services</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Services_List</div>
                        </li>
                    </ul>
                </div>
                <h2>{{ trans('services.Add_Services') }}</h2>

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
                        @foreach ($services as $service)
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
                                        <i class="fa fa-edit">{{ trans('services.Edit') }}</i>
                                    </a>

                                    <a href="{{ route('services.create', ['parentId' => $service->id]) }}" class="btn btn-sm btn-primary" title="{{ trans('services.AddSubService') }}">
                                        <i class="fa fa-plus"></i> {{ trans('services.AddSubService') }}
                                    </a>

                                    <!-- Show button with eye icon -->
                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-info" title="{{ trans('services.Show') }}">
                                        <i class="fa fa-eye"></i> {{ trans('services.Show') }}
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
