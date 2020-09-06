<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\User;

//use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends ApiController
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            $accessToken = $user->createToken('Token')->accessToken;


            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['username'] = 'username';
            $data['fullname'] = $user->name;


            $data['accessToken'] = $accessToken;
            $data['refreshToken'] = $accessToken;
            $data['roles'] = [1];
            $data['pic'] = './assets/media/users/300_25.jpg';

            return response()->json($data, 200);
        } else {
            return $this->validError(['Bilgilerinizi Kontrol Ediniz'], ['code' => 401, 'msg' => 'Bilgilerinizi Kontrol Ediniz']);
        }
    }


    public function getToken()
    {
        $user = Auth::user();

        $accessToken = $user->createToken('Token')->accessToken;

        $data['id'] = $user->id;
        $data['email'] = $user->email;
        $data['username'] = 'username';
        $data['fullname'] = $user->name;


        $data['accessToken'] = $accessToken;
        $data['refreshToken'] = $accessToken;
        $data['roles'] = [1];
        $data['pic'] = './assets/media/users/300_25.jpg';

        return response()->json($data, 200);

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if ($user->save()) {
            return response()->json('Kullanıcı başarıyla eklendi.', 200);
        } else {
            return response()->json('Kullanıcı kaydı sırasında bir sorun oluştu.', 400);
        }
    }

    public function deneme()
    {
        return 'deneme';
    }
}
