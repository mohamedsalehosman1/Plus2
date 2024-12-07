@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <h1>{{ __('Create Service') }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name_en">اسم الخدمة بالإنجليزية</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="name_ar">اسم الخدمة بالعربية</label>
                        <input type="text" name="name_ar" value="{{ old('name_ar') }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="image">صورة الخدمة</label>
                        <input type="file" name="image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (isset($parentId))
                        <input type="hidden" name="parent_id" value="{{ $parentId }}">
                    @endif

                    <button type="submit">إضافة خدمة</button>
                </form>
            </div>
        </div>
    </div>
@endsection
