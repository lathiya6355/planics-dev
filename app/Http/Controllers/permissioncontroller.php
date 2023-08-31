<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use App\Http\Requests\updateRolePermissonRequest;
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
        $permissions = $this->permissionService->getAll();
        foreach($permissions as $permission) {
            $permission['role'] = $permission->role;
        }
        if (is_null($permissions)) {
            return $this->sendError('Permission not found...!');
        } else {
            $returnHTML = view('front-end.permission.permissionDataTable')->with('permissions', $permissions)->render();
            return response()->json(['success' => true, 'html' => $returnHTML]);
            // return $this->sendResponse(permissionResource::collection($permission), 'Permission retrieved successfully...! ');
        }
    }

    public function permission_all() {
        $permission = $this->permissionService->getAll();
        // dd($permissions);
        // foreach($permissions as $permission) {
        //     $permission['role'] = $permission->role;
        // }
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
        // $role = $request->role_id;
        // $roles = explode(',', $role);
        // $permission->assignRole($roles);
        return $this->sendResponse($permission, 'Permission Created Successfully...!', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = $this->permissionService->getById($id);
        $permission['role'] = $permission->roles;
        // dd($permission);
        if (is_null($permission)) {
            return $this->sendError('Permission not found...!');
        } else {
            return $this->sendResponse(new permissionResource($permission), 'Permission retrieved successfully...!', 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $result = $request->all();
        $permission = $this->permissionService->getById($id);
        $permission = $this->permissionService->update($id, $result);
        return $this->sendResponse($permission, 'Permission updated successfully...!');
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

    // public function assignrole(Request $request)
    // {
    //     // dd($request  ->all());
    //     $role = $request->roles;
    //     // dd($role);
    //     $roles = explode(',', $role);
    //     // dd($roles);
    //     $permission  =$this->permissionService->getById($request->permission);
    //     dd($permission);
    //     $permission->assignRole($roles);
    //     return $this->sendResponse($roles, 'Roles assign...!');
    //     // $permission = $request->permission;
    //     // $permissions = explode(',', $permission);
    //     // $role = $this->roleService->getById($request->roles);
    //     // $role->givePermissionTo($permissions);
    //     // return $this->sendResponse($permissions, 'Permission assign...!');
    // }
    // public function update_role(updateRolePermissonRequest $request )
    // {
    //     $role = $request->roles;
    //     $roles = explode(',', $role);
    //     $permission = $this->permissionService->getById($request->permission);
    //     if ($permission == null) {
    //         return $this->sendError('permission does not exist..!');
    //     } else {
    //         DB::table('role_has_permissions')->where('permission_id', $request->permission)->delete();
    //         $permission->assignRole($roles);
    //         return $this->sendResponse($roles, 'Permission updated successfully...!');
    //     }
    // }
}

