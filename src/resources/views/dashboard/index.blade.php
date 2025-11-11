@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 bg-light p-4" style="background-color: #e8f5e9 !important; min-height: 100vh;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">Tasks</a>
                </li>
            </ul>
        </nav>
        <main class="col-md-10" style="padding-left: 0; padding-right: 0;">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1b5e20 !important;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Employee Task Management System</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="#">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Settings</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="row mt-4 p-3 mx-0">
                <div class="col-md-6">
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
        </main>
    </div>
</div>
@endsection