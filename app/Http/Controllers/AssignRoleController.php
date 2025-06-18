<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Role;

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
        return view('assign_roles.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'sex' => 'required|in:Male,Female',
            'contactNum' => 'required|numeric',
            'bdate' => 'required|date',
            'role' => 'required|exists:roles,id',
        ]);

        $employee = Employee::create($validated);
        $employee->roles()->attach($request->role);

        return redirect()->route('admin.dashboard')->with('success', 'Role assigned to new employee.');
    }

    public function edit($id)
    {
        $employee = Employee::with('roles')->findOrFail($id);
        $roles = Role::all();

        return view('assign_roles.edit', [
            'employee' => $employee,
            'roles'    => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'sex' => 'required|in:Male,Female',
            'contactNum' => 'required|numeric',
            'bdate' => 'required|date',
            'role' => 'required|exists:roles,id',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);
        $employee->roles()->sync([$request->role]);

        return redirect()->route('admin.dashboard')->with('success', 'Employee updated.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('assign_roles.index')->with('success', 'Employee deleted.');
    }
}
