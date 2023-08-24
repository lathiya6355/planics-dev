<?php

namespace App\Http\Controllers;

use App\Http\Requests\roleRequst;
use App\Http\Requests\roleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class rolecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();
        if (is_null($role)) {
            return $this->sendError('Role not found');
        } else {
            return $this->sendResponse($role, 'Role found...!');
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
    public function store(roleRequst $request)
    {
        $data = $request->validated();
        $data['guard_name'] = 'web';
        $role = Role::create($data);
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permission, 'Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('Role not found');
        } else {
            return $this->sendResponse($role, 'Role found');
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
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = Role::find($request->role_id);
        if (is_null($role)) {
            return $this->sendError('role does not exist..!');
        }
        DB::table('role_has_permissions')->where('role_id', $request->role_id)->delete();
        $role->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Role updated successfully...!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
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
        $role = Role::find($request->role_id);
        $role->givePermissionTo($permissions);
        return $this->sendResponse($permissions, 'Permission assign...!');
    }
}
