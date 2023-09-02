<?php

namespace App\Http\Controllers;

use App\Http\Requests\assignPermissionRequest;
use App\Http\Requests\roleRequst;
use App\Http\Requests\roleUpdateRequest;
use App\Http\Requests\updatePermissinRequest;
use App\Http\Resources\roleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\services\roleService;

class rolecontroller extends Controller
{

    private roleService $roleService;

    public function __construct(roleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getAll();
        foreach ($roles as $role) {
            $role['permissions'] = $role->permissions;
        }
        // dd($roles);
        if (is_null($roles)) {
            return $this->sendError('Role not found...!');
        } else {
            $returnHTML = view('front-end.role.roleDataTable')->with('roles', $roles)->render();
            return response()->json(['success' => true, 'html' => $returnHTML]);
        }
    }
    public function role_all() {
        $role = $this->roleService->getAll();
        if (is_null($role)) {
            return $this->sendError('role not found...!');
        } else {
            return $this->sendResponse(roleResource::collection($role), 'role retrieved successfully...! ');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,roleRequst $role)
    {
        // dd($request->all());
        $result = $role->all();
        $result['guard_name'] = 'web';
        $role = $this->roleService->create($result);
        $permission = $request->permission_id;
        // $permissions = explode(',', $permission);
        $role->givePermissionTo($permission);
        return $this->sendResponse($permission, 'Role Created Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->roleService->getById($id);
        $role['permissionsIds'] = $role->permissions->pluck('id');
        // dd($role);
        if (is_null($role)) {
            return $this->sendError('Role not found');
        } else {
            return $this->sendResponse($role, 'Role retrieved successfully...!', 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(roleUpdateRequest $request, $id)
    {
        // dd($id);
        // $result = $request->all();
        // $role = $this->roleService->getById($id);
        // $role = $this->roleService->update($id, $result);
        // return $this->sendResponse($role, 'Role updated successfully...!');
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = $this->roleService->getById($id);
        // dd($role);
        if (is_null($role)) {
            return $this->sendError('role does not exist..!');
        }
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->update(['name' => $request->name, 'guard_name' => 'web']);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Role updated successfully...!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->roleService->getById($id);
        if (is_null($role)) {
            return $this->sendError('Role not found...!');
        } else {
            $role->delete();
            return $this->sendResponse([], 'Role Deleted Successfully...!');
        }
    }

    public function assignpermission(assignPermissionRequest $request)
    {
        // dd($request->all());
        $permission = $request->permission;
        // dd($permission);
        $permissions = explode(',', $permission);
        $role = $this->roleService->getById($request->roles);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Permission assign...!');
    }

    public function update_permission(updatePermissinRequest $request)
    {
        $permission = $request->permission;
        $permissions = explode(',', $permission);
        // dd($permissions);
        $role = $this->roleService->getById($request->roles);
        if (is_null($role)) {
            return $this->sendError('role does not exist..!');
        }
        DB::table('role_has_permissions')->where('role_id', $request->roles)->delete();
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Role updated successfully...!');
    }
}
