<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getVerifiedUsers()
    {
        $users = User::all(); // Fetch all users from the database
        $new_users = [];
        foreach ($users as $user) {
            if ($user->email_verified_at != null) {
                array_push($new_users, $user);
            }
        }
        return view('verifiedUsers', ['users' => $new_users]); // Return the view with users data
    }
}
