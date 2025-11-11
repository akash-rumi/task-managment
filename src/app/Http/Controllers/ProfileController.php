<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $messages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
            'unique' => 'The :attribute has already been taken.',
            'min' => 'The :attribute must be at least :min characters.',
            'email' => 'The :attribute must be a valid email address.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], $messages);

        $user->fill($request->only('name', 'email'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->employee) {
            $request->validate([
                'phone' => ['required', 'string', 'regex:/^01[3-9]{1}[0-9]{8}$/', Rule::unique('employees')->ignore($user->employee->id)],
                'designation' => 'required|string|max:255',
            ], $messages);

            $user->employee->fill([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'designation' => $request->designation,
            ]);

            if ($user->isAdmin()) {
                $user->role = $request->has('is_admin') ? 1 : 0;
            }
            $user->employee->save();
        }

        $user->save();
        
        if($user)
        {
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } else
        {
            return redirect()->route('profile')->with('error', 'Failed to update profile.');
        }
    }
}
