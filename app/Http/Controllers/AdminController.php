<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;

class AdminController extends Controller
{
    public function adminPanel()
    {
        $roles = Role::all();
        $employees = Employee::with('roles')->get();
        return view('layouts.dashboard', compact('employees', 'roles'));
    }
}
