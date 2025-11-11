<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Employee::with('tasks');
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        
        $employees = $query->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $messages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
            'unique' => 'The :attribute has already been taken.',
            'min' => 'The :attribute must be at least :min characters.',
            'email' => 'The :attribute must be a valid email address.',
            'regex' => 'The :attribute must match the specified pattern.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'required|string|regex:/^01[3-9]{1}[0-9]{8}$/|unique:employees',
            'designation' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ],$messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 0, // Normal user by default
        ]);

        if($user)
        {
            // Create employee linked to the user
            $employee = Employee::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'designation' => $request->designation,
            ]);
        }

        if($employee && $user)
        {
            return redirect()->route('employees')->with('success', 'Employee added successfully!');
        } else
        {
            return redirect()->route('employees')->with('error', 'Failed to add employee.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {   
        $tasks = $employee->getTasks();
        return view('employees.show', compact('employee','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {   
        $messages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
            'unique' => 'The :attribute has already been taken.',
            'min' => 'The :attribute must be at least :min characters.',
            'email' => 'The :attribute must be a valid email address.',
            'regex' => 'The :attribute must match the specified pattern.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'phone' => 'required|string|regex:/^01[3-9]{1}[0-9]{8}$/|unique:employees,phone,' . $employee->id,
            'designation' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ],$messages);

        $user = $employee->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->has('is_admin') ? 1 : 0;
        
        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        // Update the employee
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->designation = $request->designation;
        $employee->save();

        if ($employee && $user) {
            return redirect()->route('employees')->with('success', 'Employee updated successfully!');
        } else {
            return redirect()->route('employees')->with('error', 'Failed to update employee.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees')->with('success', 'Employee deleted successfully!');
    }
}
