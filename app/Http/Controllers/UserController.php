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
        $user->password = bcrypt($request->password);



        if (preg_match('/[^\x01-\x7E]/', $user)) {
            return back()->withErrors(['name' => '全角文字は使用できません。']);
        }

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

            return redirect()->route('home.index');

        }
        else
        {
            return redirect()->route('users.title');
            //バックメソッドはルートとの併用不可。->は使えません。
        }
    
    }


    
    public function loginpage ()
    {
        return view('users.test');

    }

    public function show()
    {
        $user = Auth::user();
    
        
        return view('users.show', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect()->route('home.index');
    }
    
    public function title()
    {
        return view('users.title');
    }



}




