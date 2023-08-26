<?php

namespace App\Http\Controllers;

use App\Http\Requests\roleRequst;
use App\Http\Requests\roleUpdateRequest;
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
        if (is_null($roles)) {
            return $this->sendError('Role not found...!');
        } else {
            $returnHTML = view('front-end.role.roleDataTable')->with('roles', $roles)->render();
            return response()->json(['success' => true, 'html' => $returnHTML]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(roleRequst $request)
    {
        $result = $request->validated();
        $result['guard_name'] = 'web';
        $role = $this->roleService->create($result);
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permission, 'Role Created Successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->roleService->getById($id);
        if (is_null($role)) {
            return $this->sendError('Role not found');
        } else {
            return $this->sendResponse(new roleResource($role), 'Role retrieved successfully...!', 302);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = $this->roleService->getById($request->role_id);
        if (is_null($role)) {
            return $this->sendError('role does not exist..!');
        }
        DB::table('role_has_permissions')->where('role_id', $request->role_id)->delete();
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

    public function assignpermission(Request $request)
    {
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = $this->roleService->getById($request->role_id);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Permission assign...!');
    }
}
