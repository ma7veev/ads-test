<?php
    
    namespace App\Http\Controllers;
    
    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;
    use Illuminate\Foundation\Auth\RegistersUsers;
    
    class AuthController extends Controller
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
        use AuthenticatesUsers {
            login as public basicLogin;
            username as public basicUsername;
            redirectPath as protected authRedirectPath;
        }
        use RegistersUsers {
            RegistersUsers ::redirectPath insteadof AuthenticatesUsers;
            redirectPath as protected registerRedirectPath;
            RegistersUsers ::guard insteadof AuthenticatesUsers;
        }
        /**
         * Where to redirect users after login.
         *
         * @var string
         */
        protected $redirectTo = '/';
        protected $redirectPath = '/';
        
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this -> middleware('guest')
                  -> except('logout');
        }
        
        public function username()
        {
            return 'username';
        }
        
        public function login(Request $request)
        {
            if (Auth ::check()) {
                return redirect($this -> redirectPath());
            }
            $this -> validateLogin($request);
           
            /*    if ($this -> hasTooManyLoginAttempts($request)) {
                    $this -> fireLockoutEvent($request);
                    
                    return $this -> sendLockoutResponse($request);
                }*/
            if ($this -> attemptLogin($request)) {
                return $this -> sendLoginResponse($request);
            }
            $this -> register($request);
            $this -> incrementLoginAttempts($request);
            
            return $this -> sendFailedLoginResponse($request);
        }
        
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data)
        {
            return Validator ::make($data, [
                  'username' => ['required', 'string', 'max:255', 'unique:users'],
                  'password' => ['required', 'string', 'min:8'],
            ]);
        }
        
        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array $data
         * @return \App\User
         */
        protected function create(array $data)
        {
            return User ::create([
                  'username' => $data[ 'username' ],
                  'password' => Hash ::make($data[ 'password' ]),
            ]);
        }
    }
