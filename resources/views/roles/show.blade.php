@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>Role Details</h6>

                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" value="{{ $role->display_name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" disabled>{{ $role->description }}</textarea>
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
                                               disabled
                                               id="permission-{{ $permission->id }}">
                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Role List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
