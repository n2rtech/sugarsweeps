<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'photo_id' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user               = new User;
        $user->name         = $data['name'];
        $user->email        = $data['email'];
        $user->phone        = $data['phone'];
        $user->password     = Hash::make($data['password']);
        if(isset($data['photo_id'])){

            $image                      = $data['photo_id'];

            $name                       = $image->getClientOriginalName();

            $image->storeAs('uploads/users/', $name, 'public');

            $user->photo_id            = $name;

        }

        $user->save();

        $to_name        =  $user->name;
        $to_email       =  $user->email;
        $data_email     =  array("name"=> $user->name);

        Mail::send("frontend.emails.welcome", $data_email, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject("Welcome! Greetings from Sugarsweeps");
            $message->from("websales9999@gmail.com","Sugarsweeps");
        });

        $notification                       = new Notification();
        $notification->type                 = 'request-account';
        $notification->sender               = 'player';
        $notification->sender_id            = $user->id;
        $notification->receiver_id          = 0;
        $notification->save();

        return $user;
    }
}
