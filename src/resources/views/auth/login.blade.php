@extends('layouts.default')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:70vh;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <h4 class="mb-0">Welcome Back</h4>
                            <p class="text-muted small">Sign in to continue to your account</p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success small">{{ session('status') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" novalidate>
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="form-label small">Email address</label>
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    placeholder="you@example.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label small">Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    required
                                    placeholder="Your password"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block w-100 py-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection