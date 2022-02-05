<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    // protected function attemptLogin(Request $request)
    // {
    //     return (auth()->attempt(['phone_no' => $request->phone_no, 'password' => $request->password, 'admin' => 1]));
    // }

    use AuthenticatesUsers;

public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            // 'phone_no' => 'required|regex:/[0-9]{10}/|digits:10',
        ]);

        // Get user record
        $user = User::where('phone_no', $request->get('phone_no'))->first();

        // Check Condition Mobile No. Found or Not
        if(!blank($user)){
            if($request->get('phone_no') == $user->phone_no && Hash::check($request->get('password'), $user->password)) {

                // Set Auth Details
                \Auth::login($user);

                // Redirect home page
                return redirect()->route('dashboard');
            }
            \Session::put('errors', 'Your mobile number or password not match in our system..!!');
            return back();

        }else{
            \Session::put('errors', 'Your mobile number or password not match in our system..!!');
            return back();
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
