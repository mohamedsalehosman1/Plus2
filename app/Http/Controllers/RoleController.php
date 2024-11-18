<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
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


    public function show(Role $role) {}

    public function edit(Role $role) {}


    public function update(Request $request, Role $role) {}

    public function destroy($model) {}
}
