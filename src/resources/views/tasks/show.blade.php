@extends('layouts.dashboard')

@section('header', 'Task Details')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Task Details</span>
                        <div>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this Task?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label"><strong>Title:</strong></label>
                            <p id="title">{{ $task->title }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Description:</strong></label>
                            <p id="description">{{ $task->description }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="assignee" class="form-label"><strong>Assignee:</strong></label>
                            <p id="assignee">
                                @if ($task->employee_id)
                                    <a href="{{ route('employee.show', $task->employee_id) }}">{{ $task->employee->name }}</a>
                                @else
                                    Unassigned
                                @endif
                            </p>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label"><strong>Due Date:</strong></label>
                            <p id="due_date">{{ $task->due_date }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Status:</strong></label>
                            <p id="status">
                                <span class="{{ $task->status === 'In Progress' ? 'btn btn-primary' : ($task->status === 'Pending' ? 'btn btn-danger' : ($task->status === 'Completed' ? 'btn btn-success' : '')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('tasks') }}" class="btn btn-secondary">Back to Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection