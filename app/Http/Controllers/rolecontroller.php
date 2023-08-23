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
            $response = [
                'message' => 'role not found',
            ];
            $responseCode = 404;
        } else {
            $response = [
                'message' => 'role found',
                'data' => $role
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(roleRequst $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role->givePermissionTo($permissions);
        return response()->json(['message' => "role Created Successfully", 'status' => 300, 'data' => $role]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            $response = [
                'message' => 'role not found',
            ];
            $responseCode = 404;
        } else {
            // dd();
            $response = [
                'message' => 'role found',
                'data' => $role
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
        // dd($request->all());
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = Role::find($request->role_id);
        if(is_null($role)) {
            return response()->json(['message' => 'role does not exist..!']);
        }
        DB::table('role_has_permissions')->where('role_id' ,$request->role_id)->delete();
        $role->update([
            'name' => $request->name,
            'guard_name' =>'web'
        ]);
        $role->givePermissionTo($permissions);
        return response()->json(['message'=>'Role updated successfully...!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            $response = [
                'message' => 'role not found',
            ];
            $responseCode = 404;
        } else {
            $role->delete();
            $response = [
                'message' => 'role Deleted Successfully'
            ];
            $responseCode = 200;
        }
        return response()->json([$response, $responseCode]);
    }

    public function assignpermission(Request $request) {
        $permission = $request->permission_id;
        $permissions = explode(',', $permission);
        $role = Role::find($request->role_id);
        $role->givePermissionTo($permissions);
        return response()->json(['message' => 'permission assign...!']);
    }
}
