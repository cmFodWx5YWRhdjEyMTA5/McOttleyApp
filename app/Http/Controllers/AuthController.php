<?php

namespace OrionMedical\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use OrionMedical\Models\User;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use OrionMedical\Models\Role; 

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectTo = '/';


     
     public function getSignup()
    {
         $roles=Role::get();
         return view('auth.signup',compact('roles'));
    }
   

    public function postSignup(Request $request)
    {
        $this->validate($request, [
                'email'=> 'required|unique:users|email|max:255',
                'username'=> 'required|unique:users|alpha_dash|max:20',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'location'=> 'required|min:2',
                'usertype'=> 'required|min:2',
            ]);

        $assigned_role = $request->input('usertype');

        $user = new User;
        $user->email = strtolower($request->input('email'));
        $user->username = strtolower($request->input('username'));
        $user->password = bcrypt($request->input('password'));
        $user->fullname = $request->input('fullname');
        $user->location = $request->input('location');
        $user->usertype = $request->input('usertype');
        if($user->save())
        {

        $role = Role::where('name','=', $assigned_role)->first();
        $user->attachRole($role);

        return redirect()
            ->route('auth.signup')
            ->with('info','Account has successfully been created!, User can now sign in');
        }
        else
        {
        return redirect()
            ->route('auth.signup')
            ->with('Warning','Account failed to create');
        }
    }



    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
               
                'username'=> 'required',
                'password'=> 'required',
                
            ]);

        $remember_me = $request->has('remember') ? true : false; 

        if(!Auth::attempt($request->only(['username','password']),$remember_me))
        {
            return redirect()
                    ->back()
                    ->with('error','Invalid Username/Password combination. Please try again');
        }

        if(Auth::user()->usertype == 'Guest')
        {
        return redirect()
            ->route('patient-profile',Auth::user()->location)
            ->with('info','You are now signed in');
        }

         return redirect()
            ->route('dashboard')
            ->with('info','You are now signed in');

    }

    




     public function getUsers()
    {

        $users =  User::paginate(30);
       return view('auth.user', compact('users'));
    }

    public function getSignOut()
    {
        Auth::logout();
        return redirect()
            ->route('auth.signin')
            ->with('info','Please sign in');

    }
}
