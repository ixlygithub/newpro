<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin'||auth()->user()->role == 'adminuser') {
            return '/home';
        }
        return '/userpage';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     public function login(Request $request)
    {   
       
        $input = $request->all();
         
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       if($input['role']=="user"){
           
          if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'],'role' => 'user')))
            {
                $users = DB::table('users')->where('email',$input['email'])->first();
                $status=$users->status;
                if($status=="0"){//active user
                return redirect()->route('userpage');
                }
                if($status=="2"){//trail
                 $currentdate=date('Y-m-d');  
                 $usersli =DB::select("SELECT *  FROM `users` WHERE `trail_to` >= '".$currentdate."' and email='".$input['email']."'");
                 
                 if(!empty($usersli)){
                    return redirect()->route('userpage');
                 }else{
                    
                    Auth::logout();

                     return redirect()->route('login')
                    ->with('error','Email-Address And Password Are Expired.');
                 }

                }
              
            }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
           
        }
        
        
    }else{

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))

        {
            if (auth()->user()->role =="admin"||auth()->user()->role =="adminuser") {
                return redirect()->route('home');
            }
            else{
                
                return redirect('adminlogout')->with('error','Email-Address And Password Are Wrong.');;
            }
        }else{
            
            return redirect('admin')
                ->with('error','Email-Address And Password Are Wrong.');
                
        }
    }
        
          
    }
    public function admin(){
        
        if (Auth::check()) {

            Auth::logout();
             return view('auth/admin');
        }
      return view('auth/admin');
    }
    

}
