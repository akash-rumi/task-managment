@extends('layouts.dashboard')

@section('header', 'Employees')

@section('dashboard_content')
    <div class="mx-2">
        <div class="mb-4">
        <form method="GET" action="{{ route('employees') }}" class="d-flex mb-4">
            <input 
            type="text" 
            name="search" 
            placeholder="Search employees..." 
            value="{{ request('search') }}"
            class="form-control me-2" 
            style="width: 600px;"
            >
            <button type="submit" class="btn btn-outline-success">
            Search
            </button>
        </form>
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
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Employees</span>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">Add Employee</a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-{{ Auth::user()->isAdmin() ? '3' : '4' }}">Email</th>
                            <th class="col-md-2">Designation</th>
                            <th class="col-md-{{ Auth::user()->isAdmin() ? '1' : '2' }}">Tasks</th>
                            @if(Auth::user()->isAdmin())
                                <th class="col-md-2">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('employee.show', $employee->id) }}">{{ $employee->name }}</a>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->designation }}</td>
                                <td>{{ $employee->tasks->count() }}</td>
                                @if(Auth::user()->isAdmin())
                                    <td>
                                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    No employees found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection