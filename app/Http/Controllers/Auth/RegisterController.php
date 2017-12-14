<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Uuid;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
      // dd($data['filke']);
        $id = Uuid::generate();
        if (!is_null($data['file'])) {
          $datas = $data['file'];
          $destinationPath = public_path('incomefile');
          $fileName = $id.'-'.$datas->getClientOriginalName();
          $datas->move($destinationPath, $fileName);
          $path = $destinationPath.'/'.$fileName;
          $type = pathinfo($path, PATHINFO_EXTENSION);
          $imgData = file_get_contents($path);
          $base64images = 'data:image/' . $type . ';base64,' . base64_encode($imgData);
          $file = $base64images;
        }
        return User::create([
            'id' => Uuid::generate(),
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_pictures' => $file,
        ]);
    }
}
