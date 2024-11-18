@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">
                <div class="wg-box">
                    <h3>{{ trans('roles.create_role') }}</h3>

                    <!-- Role Creation Form -->
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="form">
                            <label for="name">{{ trans('roles.role_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <!-- Display Name Input -->
                        <div class="form">
                            <label for="display_name">{{ trans('roles.display_name') }}</label>
                            <input type="text" name="display_name" id="display_name" class="form-control" required>
                        </div>

                        <!-- Description Input -->
                        <div class="form">
                            <label for="description">{{ trans('roles.description') }}</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>

                        <!-- Permissions Select Box -->
                        <div class="form">
                            <label for="permissions">{{ trans('roles.assign_permissions') }}</label>
                            <select name="permissions[]" id="permissions" class="form-control" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">
                                        {{ trans('permissions.' . $permission->name) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">{{ trans('roles.create_role_button') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
