<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class permissioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::all();
        if (is_null($permission)) {
            $response = [
                'message' => 'Permission not found',
            ];
            $responseCode = 404;
        } else {
            $response = [
                'message' => 'Permission found',
                'data' => $permission
            ];
            $responseCode = 200;
        }
        return response()->json($response, $responseCode);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, permissionRequest $permission)
    {
        $data = $permission->validated();
        $permission = Permission::create($data);
        $role = $request->role_id;
        $roles = explode(',', $role);
        $permission->assignRole($roles);
        return response()->json(['message' => "permission Created Successfully", 'status' => 300, 'data' => $permission]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        if (is_null($permission)) {
            $response = [
                'message' => 'Permission not found',
            ];
            $responseCode = 404;
        } else {
            $response = [
                'message' => 'Permission found',
                'data' => $permission
            ];
            $responseCode = 200;
        }
        return response()->json($response, $responseCode);
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
            return response()->json(['message' => 'permission does not exist..!']);
        }
        DB::table('role_has_permissions')->where('permission_id', $request->permission_id)->delete();
        // dd
        $permission->update([
            'name' => isset($request->name) ? $request->name : $permission->name,
            'guard_name' => 'web'
        ]);
        $permission->assignRole($roles);
        return response()->json(['message' => 'Permission updated successfully...!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if (is_null($permission)) {
            $response = [
                'message' => 'Permission not found',
            ];
            $responseCode = 404;
        } else {
            $permission->delete();
            $response = [
                'message' => 'Permission Deleted Successfully'
            ];
            $responseCode = 200;
        }
        return response()->json([$response, $responseCode]);
    }

    public function assignrole(Request $request)
    {
        $role = $request->role_id;
        $roles = explode(',',$role);
        $permission = Permission::find($request->permission_id);
        $permission->assignRole($roles);
        return response()->json(['message' => 'Roles assign...!']);
    }
}
