<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller implements HasMiddleware
{
    private $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function middleware()
    {
        return [
            new Middleware("permission:read_admins", only: ['index', 'trash']),
            new Middleware("permission:create_admins", only: ['create', 'store']),
            new Middleware("permission:show_admins", only: ['show']),
            new Middleware("permission:block_admins", only: ['block', 'unblock']),
            new Middleware("permission:update_admins", only: ['update', 'edit']),
            new Middleware("permission:forceDelete_admins", only: ['destroy']),
            new Middleware("permission:delete_admins", only: ['destroy']),
            new Middleware("permission:readTrashed_admins", only: ['trash']),
            new Middleware("permission:restore_admins", only: ['restore']),
        ];
    }

    public function index()
    {
        $admins = $this->repository->index();
        return view('admins.index', get_defined_vars());
    }

    public function trash()
    {
        $admins = $this->repository->trash();
        return view('admins.trash', get_defined_vars());
    }

    public function create()
    {
        $roles = Role::all();
        return view('admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {

        $admin = $this->repository->store($request->validated());

        $admin->addMediaFromRequest('image')->toMediaCollection('images');


        $admin->roles()->sync($request->roles);

        return redirect()->route('admins.index')->with('success', __('Admin created successfully.'));
    }


    public function show(Admin $admin)
    {
        return view('admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();

        return view('admins.update', get_defined_vars());
    }



    public function update(AdminRequest $request, $id)
    {
        $admin = $this->repository->find($id);

        if ($request->has('password') && $request->password) {
            $admin->password = $request->password;
        } else {
            $request->request->remove('password');
        }

        $admin->update($request->except('password'));
        $admin->roles()->sync($request->roles);

        if ($request->hasFile('image')) {
            $admin->clearMediaCollection('images');
            $admin->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('admins.index')->with('success', __('Admin updated successfully.'));
    }


    public function destroy(Admin $admin)
    {
        $this->repository->destroy($admin);
        return redirect()->route('admins.index')->with('success', __('Admin soft deleted successfully.'));
    }

    public function forceDelete($id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        $this->repository->forceDelete($admin);

        return redirect()->route('admins.index')->with('success', 'تم حذف الـ Admin بشكل نهائي');
    }

    public function restore($id)
    {
        $model = $this->repository->find($id, true);
        $this->repository->restore($model);

        return redirect()->route('admins.trash')->with('success', __('Admin restored successfully.'));
    }

    public function block(Admin $admin)
    {
        $this->repository->block($admin);
        return redirect()->route('admins.index')->with('success', __('Admin blocked successfully.'));
    }

    public function unblock(Admin $admin)
    {
        $this->repository->unblock($admin);
        return redirect()->route('admins.index')->with('success', __('Admin unblocked successfully.'));
    }

    public function showProfile(Admin $admin)
    {
        $roles = Role::all();
        $admin = Auth::guard('admins')->user();
        return view('profile', get_defined_vars());
    }

    public function updateProfile(ProfileRequest $request)
    {
        $admin = Auth::guard('admins')->user();
        $data = $request->validated();
        if (isset($data["image"])) {
            $admin->clearMediaCollection('images');
            $admin->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (!$data["password"]) {
            unset($data["password"]);
        }
        $admin->roles()->sync($request->roles);

        $admin->update($data);
        return redirect()->route('admin.profile')->with('success', 'تم تحديث البيانات بنجاح!');
    }
}
