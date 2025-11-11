<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Employee;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Task::with('employee');
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }

        if ($request->has('status')) {
            $status = $request->input('status');
            if ($status) $query->where('status', $status);
        }
        $tasks = $query->get();
        return view('tasks.index', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
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
            'date' => 'The :attribute must be a valid date.',
            'in' => 'The selected :attribute is invalid.',
            'exists' => 'The selected :attribute is invalid.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|string|in:Pending,In Progress,Completed',
        ], $messages);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'employee_id' => $request->employee_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        if ($task) {
            return redirect()->route('tasks')->with('success', 'Task added successfully!');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to add task.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $messages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
            'date' => 'The :attribute must be a valid date.',
            'in' => 'The selected :attribute is invalid.',
            'exists' => 'The selected :attribute is invalid.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|string|in:Pending,In Progress,Completed',
        ], $messages);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'employee_id' => $request->employee_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        if ($task) {
            return redirect()->route('tasks')->with('success', 'Task updated successfully!');
        }else {
            return redirect()->route('tasks')->with('error', 'Failed to update task.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        if ($task) {
            return redirect()->route('tasks')->with('success', 'Task deleted successfully!');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to delete task.');
        }
    }
}
