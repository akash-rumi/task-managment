@extends('layouts.dashboard')

@section('header', 'Edit Profile')

@section('dashboard_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($user->employee)
                            <hr>
                            <h5>Employee Details</h5>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number (e.g., 01XXXXXXXXX)</label>
                                <input type="tel" class="form-control" id="phone" name="phone" pattern="01[3-9]{1}[0-9]{8}" placeholder="01XXXXXXXXX" value="{{ old('phone', $user->employee->phone) }}" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $user->employee->designation) }}" required>
                                @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(Auth::user()->isAdmin())
                                <div class="row">
                                    <div class="col-md-12 mb-3 form-check d-flex align-items-center ps-5">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="is_admin"
                                            name="is_admin"
                                            value="1"
                                            {{ old('is_admin', $user->isAdmin() ? '1' : '0') == '1' ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label ms-2" for="is_admin">Is Admin</label>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="is_admin" value="{{ $user->isAdmin() ? '1' : '0' }}">
                            @endif
                        @endif


                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection