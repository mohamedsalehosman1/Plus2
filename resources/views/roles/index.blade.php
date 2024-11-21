@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="tf-section mb-10">

                <div class="wg-box">
                    <h6>{{ trans('roles.roles_list') }}</h6>


                    <a href="{{ route('roles.create') }}"
                        class="btn btn-primary mb-3">{{ trans('roles.create_new_role') }}</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('roles.name') }}</th>
                                <th>{{ trans('roles.display_name') }}</th>
                                <th>{{ trans('roles.description') }}</th>
                                <th>{{ trans('roles.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td> @include('roles.actions.edit')
                                        @include('roles.actions.delete')
                                        @include('roles.actions.show')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
