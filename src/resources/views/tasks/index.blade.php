@extends('layouts.dashboard')

@section('header', 'Tasks')

@section('dashboard_content')
    <div class="mx-2">
        <div class="row mb-4">
            <div class="col-md-8">
                <form method="GET" action="{{ route('tasks') }}" class="d-flex">
                    <input 
                    type="text" 
                    name="search" 
                    placeholder="Search tasks..." 
                    value="{{ request('search') }}"
                    class="form-control me-2" 
                    >
                    <button type="submit" class="btn btn-outline-success">
                    Search
                    </button>
                </form>
            </div>
            <div class="col-md-4">
                <form method="GET" action="{{ route('tasks') }}" class="d-flex justify-content-end">
                    <select name="status" class="form-select me-2" onchange="this.form.submit()">
                        <option value="">Filter by Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @if(request('search') || request('status'))
                        <a href="{{ route('tasks') }}" class="btn btn-dark">Clear</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card mb-4 mx-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Tasks</span>
            <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">Add Task</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-2">Assignee</th>
                            <th class="col-md-2">Status</th>
                            <th class="col-md-1">Due Date</th>
                            <th class="col-md-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks ?? collect() as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <a href="{{ route('tasks.show', $task->id) }}"> {{$task->title }} </a></td>
                                <td>{{ \Illuminate\Support\Str::limit($task->description, 50) }}<a href="{{ route('tasks.show', $task->id) }}" class="text-primary">read more</a></td>
                                <td> 
                                    @if ($task->employee_id)
                                        <a href="{{ route('employee.show', $task->employee_id) }}">{{ $task->employee->name }} </a>
                                    @else
                                        Unassigned
                                    @endif
                                </td>
                                <td>
                                    <span class="{{ $task->status === 'In Progress' ? 'btn btn-primary' : ($task->status === 'Pending' ? 'btn btn-danger' : ($task->status === 'Completed' ? 'btn btn-success' : '')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td>{{ $task->due_date}}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this Task?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No tasks found for this employee.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection