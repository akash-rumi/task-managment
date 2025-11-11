@extends('layouts.dashboard')

@section('header', 'Employees')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <img src="{{ $employee->avatar_url ?? 'https://via.placeholder.com/150' }}" alt="PROFILE" class="img-fluid rounded mb-2">
                        </div>
                        <div class="col-sm-8">
                            <h4 class="mb-1">{{ $employee->name }}</h4>
                            <p class="mb-1"><strong>Email:</strong> {{ $employee->email ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Position:</strong> {{ $employee->designation ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $employee->phone ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Joined:</strong> {{ $employee->created_at->format('Y-m-d') ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Tasks</span>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">Add Task</a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th class="col-md-{{ Auth::user()->isAdmin() ? '2' : '3' }}">Title</th>
                            <th class="col-md-{{ Auth::user()->isAdmin() ? '4' : '5' }}">Description</th>
                            <th class="col-md-2">Status</th>
                            <th class="col-md-2">Due Date</th>
                            @if(Auth::user()->isAdmin())
                                <th class="col-md-2">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks ?? collect() as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($task->description, 50) }}<a href="#">read more</a></td>
                                <td>
                                    <span class="{{ $task->status === 'In Progress' ? 'btn btn-primary' : ($task->status === 'Pending' ? 'btn btn-danger' : ($task->status === 'Completed' ? 'btn btn-success' : '')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td>{{ $task->due_date}}</td>
                                @if(Auth::user()->isAdmin())
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this Task?')">Delete</button>
                                        </form>
                                    </td>
                                @endif
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
</div>
@endsection