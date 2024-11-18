@extends('layouts.master')

@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="tf-section mb-10">

            <div class="wg-box">
    <h6>Edit Admin</h6>

    <form method="POST" action="{{ route('admins.update', $admin->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Admin</button>
    </form>
@endsection
