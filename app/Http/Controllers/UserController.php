<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    // Method to get the data_masjid based on the logged-in user's masjid_id
    private function getMasjidData($masjidId)
    {
        return DB::table('users')
            ->join('data_masjid', 'users.masjid_id', '=', 'data_masjid.id')
            ->where('users.masjid_id', $masjidId)
            ->select('data_masjid.nama_masjid')
            ->first();
    }

    public function index()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve only the users that belong to the same masjid_id
        $users = User::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the filtered collection of users and getData to the view
        return view('admin_masjid.user-data', compact('users', 'getData'));
    }

    public function indexAddUserData()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass getData to the add-user-data view
        return view('admin_masjid.add-user-data', compact('getData'));
    }

    public function addUserData(StoreUserRequest $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Validate the incoming request data
        $validatedUser = $request->validate([
            'nama' => 'required|max:255|min:3',
            'email' => 'required|email:dns|unique:users,email',
            'role' => 'required|in:admin_masjid,takmir,remaja_masjid'
        ]);

        // Attach the masjid_id from the currently logged-in user
        $validatedUser['masjid_id'] = $user->masjid_id;  // Use masjid_id instead of user ID

        // Check if the current user is authenticated via Google (or any OAuth)
        if ($user->gauth_id) {
            // If authenticated via Google, attach the OAuth info to the new user
            $validatedUser['gauth_id'] = $user->gauth_id; // Pass the Google OAuth ID
            $validatedUser['gauth_type'] = $user->gauth_type; // Pass the OAuth provider type (e.g., 'google')

            // You can generate a default password or leave it empty if not required for OAuth users
            $validatedUser['password'] = $user->password; // Copy the password from the authenticated user (or make it optional)
        } else {
            // For regular users, generate a random password
            $validatedUser['password'] = Hash::make(Str::random(7));
        }

        // Store the validated user data in the database
        User::create($validatedUser);

        // Return back with a success message
        return redirect()->route('user.index')->with('success', 'Berhasil menambah data user!');
    }

    
    public function editUserData(UpdateUserRequest $request)
    {
        // Find the user by ID
        $user = User::findOrFail($request->user_id);
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|max:255|min:3',
            'email' => 'required|email:dns|unique:users,email,' . $user->id, // Allow the current user's email
            'role' => 'required|in:admin_masjid,takmir,remaja_masjid'
        ]);
    
        // Update the user data
        $user->update($validatedData);
    
        // Return back with a success message
        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    public function deleteUserData($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Delete the user
        $user->delete();
    
        // Redirect to /data_user with a success message
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }     
    
     
}
