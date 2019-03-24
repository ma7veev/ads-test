<?php
    
    namespace App\Http\Controllers\Auth;
    
    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;
    use Illuminate\Foundation\Auth\RegistersUsers;
    
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
        use AuthenticatesUsers, RegistersUsers {
            login as public basicLogin;
            username as public basicUsername;
            RegistersUsers::guard insteadof AuthenticatesUsers;
            RegistersUsers::redirectPath insteadof AuthenticatesUsers;
        }
        /**
         * Where to redirect users after login.
         *
         * @var string
         */
        protected $redirectTo = '/';
        
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public
        function __construct()
        {
        //    dd('cons');
            $this -> middleware('guest')
                  -> except('logout');
        }
        public function username()
        {
            return 'username';
        }
        public
        function login(Request $request)
        {
         //   dd('00');
            $this -> validateLogin($request);
         //   dd('11');
            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
        /*    if ($this -> hasTooManyLoginAttempts($request)) {
                $this -> fireLockoutEvent($request);
                dd(0);
                
                return $this -> sendLockoutResponse($request);
            }*/
            if ($this -> attemptLogin($request)) {
           //     dd(1);
                
                return $this -> sendLoginResponse($request);
            }
         //   dd('121');
          //  dd($request -> all());
            $this->register($request);
            dd('reg failed');
            if ($this -> attemptLogin($request)) {
                dd('true');
                
                return $this -> sendLoginResponse($request);
            }
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this -> incrementLoginAttempts($request);
            
            return $this -> sendFailedLoginResponse($request);
        }
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data)
        {
            return Validator::make($data, [
             //     'name' => ['required', 'string', 'max:255'],
                  'username' => ['required', 'string', 'max:255', 'unique:users'],
                  'password' => ['required', 'string', 'min:8'],
            ]);
        }
    
        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array  $data
         * @return \App\User
         */
        protected function create(array $data)
        {
           // dd($data);
            return User::create([
             //     'name' => $data['name'],
                  'username' => $data['username'],
                  'password' => Hash::make($data['password']),
            ]);
        }
    }
