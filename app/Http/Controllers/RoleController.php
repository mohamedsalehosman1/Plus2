<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RoleRepositories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    private $repository;

    public function __construct(RoleRepositories $repository)
    {
        $this->repository = $repository;
    }
    public static function middleware()
    {
        return [
            new Middleware("permission:read_roles", only: ['index']),
            new Middleware("permission:create_roles", only: ['create', 'store']),
            new Middleware("permission:show_roles", only: ['show']),
            new Middleware("permission:update_roles", only: ['update', "edit"]),
            new Middleware("permission:delete_roles", only: ['destroy']),

        ];
    }
    public function index()
    {
        $roles = $this->repository->index();
        return view('roles.index', get_defined_vars());
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', get_defined_vars());
    }
    public function store(RoleRequest $request)
    {

        $role = $this->repository->store($request->validated());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }


    public function show(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.show', compact('role', 'permissions', 'rolePermissions'));
    }


    public function edit(Role $role)
    {

        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.update', get_defined_vars());
    }


    public function update(RoleRequest $request, Role $role)
    {
        $this->repository->update($request->validated(), $role);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', __('Role updated successfully.'));
    }

    public function destroy(Role $role)
    {
        $this->repository->destroy($role);
        return redirect()->route('roles.index')->with('success', __('Role soft deleted successfully.'));
    }
}
