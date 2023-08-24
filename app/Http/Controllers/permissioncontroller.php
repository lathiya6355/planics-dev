<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use App\Http\Resources\permissionResource;
use App\services\permissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class permissioncontroller extends Controller
{
    private permissionService $permissionService;

    public function __construct(permissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     **/
    public function index()
    {
        $permission = $this->permissionService->getAll();
        if (is_null($permission)) {
            return $this->sendError('Permission not found...!');
        } else {
            return $this->sendResponse(permissionResource::collection($permission), 'Permission retrieved successfully...! ');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, permissionRequest $permission)
    {
        $result = $permission->all();
        $result['guard_name'] = 'web';
        $permission = $this->permissionService->create($result);
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission->assignRole($roles);
        return $this->sendResponse($permission, 'Permission Created Successfully...!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = $this->permissionService->getById($id);
        if (is_null($permission)) {
            return $this->sendError('Permission not found...!');
        } else {
            return $this->sendResponse(new permissionResource($permission), 'Permission retrieved successfully...!', 302);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission = $this->permissionService->getById($request->permission_id);
        if (is_null($permission)) {
            return $this->sendError('permission does not exist..!');
        } else {
            DB::table('role_has_permissions')->where('permission_id', $request->permission_id)->delete();
            $permission->update(['guard_name' => 'web', 'name' => isset($request->name) ? $request->name : $permission->name]);
            $permission->assignRole($roles);
            return $this->sendResponse($roles, 'Permission updated successfully...!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = $this->permissionService->getById($id);
        if (is_null($permission)) {
            return $this->sendError('Permission not found...!');
        } else {
            $permission->delete();
            return $this->sendResponse([], 'Permission Deleted Successfully...!');
        }
    }

    public function assignrole(Request $request)
    {
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission = Permission::find($request->permission_id);
        $permission->assignRole($roles);
        return $this->sendResponse($roles, 'Roles assign...!');
    }
}
