<?php
//ユーザー認証機能の作成

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //ユーザー登録のコード
    public function create()
    {
        return view('users.create');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('home.index'); // ダッシュボードやホームページにリダイレクト
    }

    //ユーザーログインのコード
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth::attempt(['email' => $email , 'password' => $password]))
        {
            Auth::user()->name;
        }
        else
        {
            $msg = 'ログインに失敗しました。';
        }
    
    }
    
    public function loginpage ()
    {
        return view('users.test');

    }

    



}




