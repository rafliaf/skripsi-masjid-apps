<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RegisterMasjid;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRegisterMasjidRequest;
use App\Http\Requests\UpdateRegisterMasjidRequest;
use Illuminate\Support\Facades\Auth;

class RegisterMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegisterMasjidRequest  $request
     * @return \Illuminate\Http\Response
     */
 
     //  register
     public function store(StoreRegisterMasjidRequest $request)
     {
         // Validate the registration request
         $validatedDataMasjid = $request->validate([
             'nama_masjid' => 'required|max:255|min:5',
             'alamat_masjid' => 'required|min:5|max:255',
             'email' => 'required|email:dns|unique:data_masjid',
             'password'=> 'required|min:5|max:255',
             'role' => 'admin_masjid'
         ]);
     
         // Hash the password
         $validatedDataMasjid['password'] = Hash::make($validatedDataMasjid['password']);
     
         // Automatically assign the role
         $validatedDataMasjid['role'] = 'admin_masjid';
     
         // Create the new Masjid entry
         $masjid = RegisterMasjid::create($validatedDataMasjid);
     
         // Create a new user entry corresponding to the mosque
         $userMasjid = [
             'masjid_id' => $masjid->id,
             'nama' => $masjid->nama_masjid, 
             'nama_masjid' => $masjid->nama_masjid, 
             'alamat' => $masjid->alamat_masjid, 
             'email' => $masjid->email,
             'password' => $masjid->password,
             'role' => 'admin_masjid', 
         ];
     
         // Check if it's a Google OAuth registration
         if ($request->has('gauth_id')) {
             $userMasjid['gauth_id'] = $request->input('gauth_id');
             $userMasjid['gauth_type'] = 'google';
         }
     
         // Create the new user
         User::create($userMasjid);
     
         // Store userMasjid data in the session
         session(['userMasjid' => $userMasjid]);
     
         // Redirect with success message
         return redirect()->back()->with('registration_success', true);
     }
     

    // landing page
    public function landingPage()
    {
        return view('landing_page.landing-page');
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisterMasjid  $registerMasjid
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterMasjid $registerMasjid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegisterMasjid  $registerMasjid
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterMasjid $registerMasjid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegisterMasjidRequest  $request
     * @param  \App\Models\RegisterMasjid  $registerMasjid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegisterMasjidRequest $request, RegisterMasjid $registerMasjid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisterMasjid  $registerMasjid
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterMasjid $registerMasjid)
    {
        //
    }
}
