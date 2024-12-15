@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    <h3>{{ trans('roles.create_role') }}</h3>

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="form">
                            <label for="name">{{ trans('roles.role_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Name Input -->
                        <div class="form">
                            <label for="display_name">{{ trans('roles.display_name') }}</label>
                            <input type="text" name="display_name" id="display_name" class="form-control">
                            @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Input -->
                        <div class="form">
                            <label for="description">{{ trans('roles.description') }}</label>
                            <input type="text" name="description" id="description" class="form-control">
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Permissions Select Box -->
                        <div class="form">
                            <label for="permissions">{{ trans('roles.assign_permissions') }}</label>

                            <select name="permissions[]" id="permissions"  title="{{ trans('roles.assign_permissions') }}" class="form-control select-picker"
                                data-live-search="true" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">
                                        {{ trans('permissions.' . $permission->name) }}
                                    </option>
                                @endforeach
                            </select>



                            @error('permissions')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">{{ trans('roles.create_role_button') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
