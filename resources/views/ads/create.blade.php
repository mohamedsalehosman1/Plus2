@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('ads.AddNewAd') }}</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('ads.Title') }}:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ trans('ads.Description') }}:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ trans('ads.Status') }}:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ trans('ads.Active') }}</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ trans('ads.Inactive') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">{{ trans('ads.Vendor') }}:</label>
                        @if(auth('vendors')->check())
                            <input type="hidden" name="vendor_id" value="{{ auth('vendors')->user()->id }}">
                        @else
                            <select name="vendor_id" id="vendor_id" class="form-control" required>
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}" {{ old('vendor_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('ads.Image') }}</label>
                        <input type="file" name="image" value="{{ old('image') }}" id="image" class=" dropify" accept="image/*">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('ads.AddAd') }}</button>
                    <a href="{{ route('ads.index') }}" class="btn btn-secondary">{{ trans('ads.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
