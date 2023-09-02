<?php

namespace App\Http\Controllers;

use App\Models\herosection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class dashboardController extends Controller
{
    public function index() {
        $heroSection = herosection::count();
        return $this->sendResponse($heroSection, 'Hero section Count...!', 200);
    }

    public function role() {
        $roles = Role::count();
        return $this->sendResponse($roles, 'Role Count Successfully...!', 200);
    }
}
