@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="wg-box">
                    <h6>{{ trans('vendors.edit_vendor') }}</h6>

                    <form method="POST" action="{{ route('vendors.update', $vendor->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ trans('vendors.vendor_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $vendor->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('vendors.vendor_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $vendor->email }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('vendors.password') }} ({{ trans('vendors.leave_blank_for_current_password') }})</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('vendors.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <!-- خدمة الأم -->
                        <div class="form-group">
                            <label for="base_service_id">{{ trans('vendors.select_service') }}</label>
                            <select name="base_service_id" id="base_service_id" class="form-control" onchange="updateChildServices()">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                        @if($vendor->service && $vendor->service->parent_id == $service->id) selected @endif>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- خدمة الابن -->
                        <div class="form-group">
                            <label for="service_id">{{ trans('vendors.select_child_service') }}</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">Select Child Service</option>
                            </select>
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- رفع الصورة -->
                        <div class="form-group">
                            <label for="image">{{ trans('admins.upload_image') }}</label>
                            <input type="file" name="image" id="image" class="form-control dropify" accept="image/*" data-default-file="{{ $vendor->getFirstMediaUrl('images') }}" data-allowed-file-extensions="png jpg jpeg">
                        </div>

                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">{{ trans('vendors.update_vendor') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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

                        // إذا كان هناك خدمة فرعية مرتبطة بالفيندور، سيتم تحديدها
                        if (child.id == "{{ $vendor->service_id }}") {
                            option.selected = true;
                        }

                        childServiceSelect.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.value = "";
                    option.textContent = "No child services available";
                    childServiceSelect.appendChild(option);
                }
            } else {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "Select Child Service";
                childServiceSelect.appendChild(option);
            }
        }

        // يتم تحديث الخدمات الفرعية عند تحميل الصفحة لأول مرة
        document.addEventListener('DOMContentLoaded', updateChildServices);
    </script>
@endsection
