<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;



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
    protected function authenticated(Request $request, $user){

        $user_other_info = User::where('id',Auth::user()->id)->first();    

        if($user_other_info->hasRole('agent')) {
            return redirect()->intended('/agentdashbord');
        }
        else if($user_other_info->hasRole('user')) {
            return redirect()->intended('/userdashboard');
        }
        else if($user_other_info->hasRole('admin')) { 
            return redirect()->intended('/dashboard');
        }
        else{
            echo 'you are not allowed';
        }
    }







    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   
            protected $redirectTo = '/dashboard';
        

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();




        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login')
            ->withSuccess('Terimakasih, selamat datang kembali!');




    }
}
