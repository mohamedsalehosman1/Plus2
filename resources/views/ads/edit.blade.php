@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('ads.EditAd') }}</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route("ads.update", $ad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">{{ trans('ads.AdTitle') }}</label>
                        <input type="name" id="name" name="name" class="form-control"
                            value="{{ old('title', $ad->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="description">{{ trans('ads.Description') }}</label>
                        <textarea id="description" name="description" class="form-control" required>{{ old('description', $ad->description) }}</textarea>
                    </div>





                    <div class="form-group">
                        <label for="status">{{ trans('ads.Status') }}</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active" {{ $ad->status == 'active' ? 'selected' : '' }}>
                                {{ trans('ads.Active') }}
                            </option>
                            <option value="inactive" {{ $ad->status == 'inactive' ? 'selected' : '' }}>
                                {{ trans('ads.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">{{ trans('ads.Vendor') }}</label>
                        <select id="vendor_id" name="vendor_id" class="form-control" required>
                            @foreach ($vendors as $id => $name)
                                <option value="{{ $id }}" {{ $id == $ad->vendor_id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
 <div class="dropify-wrapper">
                        <label for="image">{{ trans('ads.AdImage') }}</label>
                        <input type="file" name="image" id="image" class=" dropify"
                        accept="image/*" data-default-file="{{ $ad->getFirstMediaUrl('images')}}">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('ads.UpdateAd') }}</button>
                    <a href="{{ route("ads.index") }}" class="btn btn-secondary">{{ trans('ads.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
