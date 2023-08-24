<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use App\services\permissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class permissioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private permissionService $permissionService;

    public function __construct(permissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permission = Permission::all();
        if (is_null($permission)) {
            return $this->sendError('Permission not found');
        } else {
            return $this->sendResponse($permission, 'Permission found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, permissionRequest $permission)
    {
        $data = $permission->validated();
        $data['guard_name'] = 'web';
        $permission = Permission::create($data);
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission->assignRole($roles);
        return $this->sendResponse($permission, 'permission Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        if (is_null($permission)) {
            return $this->sendError('Permission not found');
        } else {
            return $this->sendResponse($permission, 'Permission found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission = Permission::find($request->permission_id);
        if (is_null($permission)) {
            return $this->sendError('permission does not exist..!');
        }
        DB::table('role_has_permissions')->where('permission_id', $request->permission_id)->delete();
        $permission->update([
            'name' => isset($request->name) ? $request->name : $permission->name,
            'guard_name' => 'web'
        ]);
        $permission->assignRole($roles);
        return $this->sendResponse($roles, 'Permission updated successfully...!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
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
