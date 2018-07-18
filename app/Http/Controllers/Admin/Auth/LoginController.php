<?php

namespace Seasonofjubilee\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    use AuthenticatesUsers;

    protected $lockoutTime;

    protected  $maxLoginattempts;

    protected $auth;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin-guest')->except('logout');
        $this->lockoutTime = 6;
        $this->maxLoginattempts = 3;
    }

    public function index(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
            return redirect()->back()
                ->withErrors('Incorrect email or password.')
                ->with('status', 'danger');
        }else
        {
            if ($this->guard()->attempt([
                'email' => $email,
                'password' => $password,
            ], $request->has($remember))
            ) {
                $this->clearLoginAttempts($request);
                return redirect()->intended('/admin/home');
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()->back()
                    ->withErrors('Incorrect email or password.')
                    ->with('status', 'danger')
                    ->withInput($request->only('email'));
            }
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login')
            ->with('status', 'success')
            ->with('message', 'Logged out');

    }

    //Get the guard to authenticate Seller
    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts($this->throttleKey(
            $request),
            $this->maxLoginattempts,
            $this->lockoutTime
        );
    }
}
