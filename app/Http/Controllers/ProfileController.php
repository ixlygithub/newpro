<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use DB;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }
    public function index()
    {
        return view('userdashboard/account_final');
    }
    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
         //dd($request->all());
        auth()->user()->update($request->all());
        if(auth()->user()->role=='user'){
            $request->session()->flash('success', 'Profile updated successfully!');
            return redirect('/myaccount')->with('success', 'Profile updated successfully!');
        }else{
            $request->session()->flash('success', 'Profile updated successfully!');
            return back()->withStatus(__('Profile successfully updated.'));
        }
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
    
 
    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
    //For Social Icons
     public function socialupdate(Request $request)
    {
        // dd($request->get('google_plus'));
        DB::table('users')->where('id',  auth()->user()->id)->update(['google_plus' => $request->get('google_plus'),'facebook'=>$request->get('facebook'),'twitter'=>$request->get('twitter')]);
        return back()->withStatus(__('Social Links successfully updated.'));
    }
}
