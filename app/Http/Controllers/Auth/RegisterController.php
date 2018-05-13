<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
                    'name' => 'required|max:255',
                    'username' => 'required|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'profile-register' => 'required',
                ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if($data['profile-register'] == "PNG" )
            $this->redirectTo = "/PNG/home";
        elseif($data['profile-register'] == "QA")
            $this->redirectTo = "/QA/home";
        elseif($data['profile-register'] == "OPR")
            $this->redirectTo = "/OPR/home";

        // if($data['profile-register'] == "QA" ||
        //    $data['profile-register'] == "OPR"){
        //     $user = User::where('type', $data['profile-register'])->first();

        //     if($user){
        //         return redirect()->to('/register/failed');              
        //     }
        // }

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['profile-register'],
        ]);
    }
}
