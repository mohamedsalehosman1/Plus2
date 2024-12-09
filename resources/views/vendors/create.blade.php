@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    <h3>{{ trans('vendors.create_vendor') }}</h3>

                    <form method="POST" action="{{ route('vendors.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('vendors.vendor_name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">{{ trans('vendors.vendor_title') }}</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('vendors.vendor_email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('vendors.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('vendors.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">{{ trans('admins.upload_image') }}</label>
                            <input type="file" name="image" value="{{ old('image') }}" id="image" class="form-control dropify" accept="image/*">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Selection (for Parent Service) -->
                        <div class="form-group">
                            <label for="base_service_id">Service</label>
                            <select name="base_service_id" id="base_service_id" class="form-control" onchange="updateChildServices()">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Child Service Selection -->
                        <div class="form-group">
                            <label for="service_id">Child Service</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">Select Child Service</option>
                                <!-- Child services will be dynamically loaded here -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ trans('vendors.create_new_vendor') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // بيانات الخدمات مع الأطفال، تم تمريرها من السيرفر (blade)
        const services = @json($services);

        function updateChildServices() {
            const serviceId = document.getElementById('base_service_id').value;
            const childServiceSelect = document.getElementById('service_id');

            // إعادة تعيين الخيارات السابقة
            childServiceSelect.innerHTML = '<option value="">Select Child Service</option>';

            // إذا تم اختيار خدمة
            if (serviceId) {
                // العثور على الخدمة المختارة
                const selectedService = services.find(service => service.id == serviceId);

                // إذا كانت هناك خدمات فرعية
                if (selectedService && selectedService.children) {
                    selectedService.children.forEach(child => {
                        const option = document.createElement('option');
                        option.value = child.id;
                        option.textContent = child.name;
                        childServiceSelect.appendChild(option);
                    });
                } else {
                    // إذا لم تكن هناك خدمات فرعية
                    const option = document.createElement('option');
                    option.value = "";
                    option.textContent = "No child services available";
                    childServiceSelect.appendChild(option);
                }
            } else {
                // إذا لم يتم اختيار خدمة
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "Select Child Service";
                childServiceSelect.appendChild(option);
            }
        }
    </script>
@endsection
