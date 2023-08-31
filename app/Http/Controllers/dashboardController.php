<?php

namespace App\Http\Controllers;

use App\Models\herosection;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index() {
        $heroSection = herosection::count();
        return $this->sendResponse($heroSection, 'Permission Created Successfully...!', 200);
    }
}
