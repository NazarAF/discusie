<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Profile Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles view user profile
    | and user request for edit, and delete account.
    |
    */

    /**
     * Create view user profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('content.profile', ['type_menu' => 'profile']);
    }

    /**
     * Update user profile.
     *
     * @param \App\Models\User $profile
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $profile)
    {
        if ($request->section == 'profile') {
            $validation = Validator::make($request->all(), [
                'nickname' => 'required|max:50',
                'bio' => 'max:200',
                'email' => 'required|email|unique:users,email,' . $profile->id_user . ',id_user|max:25',
                'username' => 'required|unique:users,username,' . $profile->id_user . ',id_user|min:5|max:20',
            ]);
            $msg = 'Edit Profile';
        } else if ($request->section == 'notebook') {
            $validation = Validator::make($request->all(), [
                'note' => 'max:255',
            ]);

            $msg = 'Edit Notebook';
        } else {
            $validation = Validator::make($request->all(), [
                'password' => 'required',
            ]);
            $msg = 'Reset Password';
        }

        if ($validation->fails())
            return response([
                'title' => 'Failed!',
                'type' => 'error',
                'message' => $msg,
            ], 200);

        if ($request->section == 'profile') {
            $photo = $profile->profile ?? null;
            if ($request->file('profile')) {
                if ($photo)
                    Storage::delete($profile->profile);

                $photo = $request->file('profile')->store('profiles');
            }

            $profile->update([
                'profile' => $photo,
                'nickname' => $request->nickname,
                'bio' => $request->bio,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
            ]);
        } else if ($request->section == 'notebook') {
            $profile->update([
                'note' => $request->note,
            ]);
        } else {
            $profile->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return response([
            'title' => 'Success!',
            'type' => 'success',
            'message' => $msg,
        ], 200);
    }

    /**
     * Delete data user account.
     *
     * @param \App\Models\User $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profile)
    {
        if ($profile) {
            if (User::where('role', '=', 1)->count() == 1 && $profile->role) {
                return response([
                    'title' => 'Failed!',
                    'type' => 'error',
                    'message' => 'Delete User',
                ], 200);
            } else {
                $profile->delete();
                return response([
                    'title' => 'Success!',
                    'type' => 'success',
                    'message' => 'Delete User',
                ], 200);
            }
        } else {
            return response([
                'title' => 'Failed!',
                'type' => 'error',
                'message' => 'Delete User',
            ], 200);
        }
    }

    /**
     * Reset password user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset() {
        return view('auth.reset');
    }
}
