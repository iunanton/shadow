<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    use RegistersUsers {
        showRegistrationForm as traitShowRegistrationForm;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (request()->hasValidSignature() && $id = request()->id) {
            if (User::where('id', $id)->doesntExist()) {
                return $this->traitShowRegistrationForm()->with('id', $id);
            }
        }

        return abort(404);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('Y-m-d');
        $messages = ['date_of_birth.before' => 'Sorry, Shadow is 18 and up only. Come back later!'];
        return Validator::make($data, [
            'id' => 'required|string|max:16|unique:users',
            'username' => 'required|string|alpha_num|max:255|unique:users',
            'name' => 'required|string|max:255|different:username',
            'date_of_birth' => 'required|date|before:'.$before,
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $profile = Profile::create([
            'user_id' => $data['id'],
            'dateOfBirth' => $data['date_of_birth'],
        ]);

        return User::create([
            'id' => $data['id'],
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'profile_id' => $profile->id,
            'password' => Hash::make($data['password']),
        ]);
    }
}
