@extends('layouts.master')

@section('content')
    <div class="main-content">

        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>Edit Admin</h6>

                    <form method="POST" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $admin->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $admin->email }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password (Leave blank to keep current password)</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="roles">{{ trans('admins.assign_role') }}</label>
                            <select name="roles[]" id="roles" class="form-select">
                                <option value="" disabled>---- Choose Role ----</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($admin->hasRole($role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">{{ trans('admins.upload_image') }}</label>
                            <input type="file" name="image" id="image" class="form-control dropify"
                                accept="image/*" data-allowed-file-extensions="pdf png jpg jpeg"
                                data-default-file="{{ $admin->getFirstMediaUrl('images') ? $admin->getFirstMediaUrl('images') : '' }}">

                        </div>

                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
