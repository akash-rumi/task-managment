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
                    <a class="nav-link text-dark" href="{{ route('employees') }}">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('tasks') }}">Tasks</a>
                </li>
            </ul>
        </nav>
        <main class="col-md-10" style="padding-left: 0; padding-right: 0;">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1b5e20 !important;">
                <div class="container-fluid">
                    <span class="navbar-brand">Employee Task Management System</span>
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
                                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit',  Auth::user()->id) }}">Edit Profile</a>
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
            <h1 class="p-3 mx-0">@yield("header", "Dashboard")</h1>
            @yield("dashboard_content")
        </main>
    </div>
</div>
@endsection