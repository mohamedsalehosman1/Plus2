@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h2>{{ trans('ads.AddNewAd') }}</h2>

                <!-- Display any validation errors -->
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

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="name">{{ trans('ads.Title') }}:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description">{{ trans('ads.Description') }}:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Status Field -->
                    <div class="form-group">
                        <label for="status">{{ trans('ads.Status') }}:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ trans('ads.Active') }}</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ trans('ads.Inactive') }}</option>
                        </select>
                    </div>

                    <!-- Vendor Field (Hidden for Vendor Users) -->
                    <div class="form-group">
                        <label for="vendor_id">{{ trans('ads.Vendor') }}:</label>
                        @if(auth('vendors')->check())
                            <!-- If vendor is logged in, pass their ID via a hidden field -->
                            <input type="hidden" name="vendor_id" value="{{ auth('vendors')->user()->id }}">
                        @else
                            <!-- If not a vendor, allow admin to select a vendor -->
                            <select name="vendor_id" id="vendor_id" class="form-control" required>
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}" {{ old('vendor_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <!-- Image Upload Field -->
                    <div class="form-group">
                        <label for="image">{{ trans('ads.Image') }}:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">{{ trans('ads.AddAd') }}</button>
                    <a href="{{ route('ads.index') }}" class="btn btn-secondary">{{ trans('ads.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
