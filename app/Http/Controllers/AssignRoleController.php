<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Sex;

class AssignRoleController extends Controller
{
    public function index()
    {
        $employees = Employee::with('roles')->get();
        $roles = Role::all();
        return view('assign_roles.index', compact('employees', 'roles'));
    }


    public function create()
    {
        $roles = Role::all();
        $sexes = Sex::all();
        return view('assign_roles.create', [
            'roles' => $roles,
            'sexes' => $sexes
        ]);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'sex' => 'required|exists:sexes,id',
            'contactNum' => 'required|numeric',
            'bdate' => 'required|date',
            'role' => 'required|exists:roles,id',
        ]);

        $employee = Employee::create($validated);
        $employee->roles()->attach($request->role);
        $employee->sexes()->attach($request->sex);

        return redirect()->route('admin.dashboard')->with('success', 'Role assigned to new employee.');
    }

    public function edit($id)
    {
        $employee = Employee::with('roles')->findOrFail($id);
        $roles = Role::all();
        $sexes = Sex::all();

        return view('assign_roles.edit', [
            'employee' => $employee,
            'roles' => $roles,
            'sexes' => $sexes
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'sex' => 'required|exists:sexes,id',
            'contactNum' => 'required|numeric',
            'bdate' => 'required|date',
            'role' => 'required|exists:roles,id',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);
        $employee->roles()->sync([$request->role]);
        $employee->sexes()->sync([$request->sex]);

        return redirect()->route('admin.dashboard')->with('success', 'Employee updated.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Employee deleted.');
    }
}
