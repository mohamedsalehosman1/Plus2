@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>Edit Role</h6>

                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $role->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="display_name">Display Name</label>
                            <input type="text" name="display_name" id="display_name" class="form-control"
                                value="{{ old('display_name', $role->display_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $role->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('permissions.assign_permissions') }}</label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" class="form-check-input"
                                                   value="{{ $permission->id }}"
                                                   @if (in_array($permission->id, $rolePermissions)) checked @endif
                                                   id="permission-{{ $permission->id }}">
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
