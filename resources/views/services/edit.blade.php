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
                            <div class="text-tiny">Edit_Service</div>
                        </li>
                    </ul>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <h2>{{ trans('services.Edit') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name_en">{{ trans('services.Name_English') }}</label>
                        <input type="text" id="name_en" name="name:en" class="form-control" value="{{ $service->translate('en')->name }}" >
                    </div>

                    <div class="form-group">
                        <label for="name_ar">{{ trans('services.Name_Arabic') }}</label>
                        <input type="text" id="name_ar" name="name:ar" class="form-control" value="{{  $service->translate('ar')->name }}" >
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('services.Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @if ($service->hasMedia('images'))
                            <img src="{{ $service->getFirstMediaUrl('images') }}" alt="Ad Image" width="100" height="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ trans('services.Update_Service') }}</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">{{ trans('services.Cancel') }}</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
