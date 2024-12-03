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

                <form action="{{ route("ads.update", $Ad->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">{{ trans('ads.AdTitle') }}</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title', $Ad->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ trans('ads.Description') }}</label>
                        <textarea id="description" name="description" class="form-control" required>{{ old('description', $Ad->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="ad_image">{{ trans('ads.AdImage') }}</label>
                        <input type="file" id="ad_image" name="ad_image" class="form-control">
                        @if ($Ad->ad_image)
                            <img src="{{ asset('storage/' . $Ad->ad_image) }}" alt="Ad Image" class="mt-2" width="100">
                        @endif
                    </div>





                    <div class="form-group">
                        <label for="status">{{ trans('ads.Status') }}</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active" {{ $Ad->status == 'active' ? 'selected' : '' }}>
                                {{ trans('ads.Active') }}
                            </option>
                            <option value="inactive" {{ $Ad->status == 'inactive' ? 'selected' : '' }}>
                                {{ trans('ads.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">{{ trans('ads.Vendor') }}</label>
                        <select id="vendor_id" name="vendor_id" class="form-control" required>
                            @foreach ($vendors as $id => $name)
                                <option value="{{ $id }}" {{ $id == $Ad->vendor_id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('ads.UpdateAd') }}</button>
                    <a href="{{ route("ads.index") }}" class="btn btn-secondary">{{ trans('ads.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
