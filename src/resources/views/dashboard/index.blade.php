@extends('layouts.dashboard')

@section('header', 'Dashboard')

@section('dashboard_content')
    <div class="row mt-4 p-3 mx-0">
        <div class="col-md-6 mx-0">
            <div class="card text-center" style="background-color: #e3f2fd;">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <p class="card-text">{{ $totalEmployees }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center" style="background-color: #f3e5f5;">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks</h5>
                    <p class="card-text">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 p-3 mx-0">
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #e8f5e9;">
                <div class="card-body">
                    <h5 class="card-title">In Progress Tasks</h5>
                    <p class="card-text">{{ $inProgressTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #fff3e0;">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #fce4ec;">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection