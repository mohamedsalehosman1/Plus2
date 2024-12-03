@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>{{ trans('ads.AdsList') }}</h3>
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
                <h2>{{ trans('ads.AdsList') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('ads.Name') }}</th>
                            <th>{{ trans('ads.Description') }}</th>
                            <th>{{ trans('ads.Status') }}</th>
                            <th>{{ trans('ads.Image') }}</th>
                            <th>{{ trans('ads.Vendor') }}</th>
                            <th>{{ trans('ads.Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ads as $ad)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ad->name }}</td>
                                <td>{{ $ad->description }}</td>
                                <td>
                                    <form action="{{ route('ads.updateStatus', $ad->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                   name="is_active" {{ $ad->is_active ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}" alt="Ad Image" width="50" height="50">
                                    @else
                                        {{ trans('ads.NoImage') }}
                                    @endif
                                </td>
                                <td>{{ $ad->vendor->name }}</td>
                                <td>
                                    @include('ads.actions.edit')
                                    @include('ads.actions.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($ads->isEmpty())
                    <p>{{ trans('ads.NoAdsFound') }}</p>
                @endif

                @if (auth('admins')->check() || auth('vendors')->check())
                    <a href="{{ route('ads.create') }}" class="btn btn-primary">
                        {{ trans('ads.AddNewAd') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
