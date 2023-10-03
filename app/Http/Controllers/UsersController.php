<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->toArray());
        return $request;
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        // Validate input
        $validate = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
//        dd($validate);
        // Check if the current password matches
        if (!Hash::check($currentPassword, $user->password)) {

            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($newPassword);
        $user->save();

//        return redirect('/login')->with('success', 'Password changed successfully.');
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login')->with('success', 'Password changed successfully.');
    }

    public function showUpdatePassword(User $user)
    {
        return view('show_password_update');
    }

    private function guard()
    {
        return Auth::guard();
    }
}
