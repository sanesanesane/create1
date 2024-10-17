<?php

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
        $user_email =$request->input('email');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->password);



        if (preg_match('/[^\x01-\x7E]/', $user)) {
            return back()->withErrors(['name' => '全角文字は使用できません。']);
        }

        if (User::where('email', $user_email)->exists()) 
        {
            return redirect()->route('users.title')->with('error',"こちらのユーザーは既に登録されています。");
        }

        $user->email = $user_email;
        $user->save();

        return redirect()->route('home.index');
        // ダッシュボードやホームページにリダイレクト
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
            return redirect()->route('users.title')->with('error',"ID又はパスワードが違います。");
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

    public function edit(User $user)
    {
        return view ('users.edit' , compact('user'));
    
    }

    public function editpass(User $user)
    {
        return view ('users.editpass' , compact('user'));
    
    }

    public function update(Request $request, User $user)
    {
        $user_email =$request->input('email');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        
        if (preg_match('/[^\x01-\x7E]/', $user)) {
            return back()->withErrors(['name' => '全角文字は使用できません。']);
        }

        if (User::where('email', $user_email)->exists()) 
        {
            return redirect()->route('users.title')->with('error',"こちらのユーザーは既に登録されています。");
        }

        $user->email = $user_email;
        $user->update();

        return redirect()->route('home.index');
        // ダッシュボードやホームページにリダイレクト
    
    }

    public function updatepass(Request $request, User $user)
    {
        $user->password = bcrypt($request->password);
        $user->update();

        return redirect()->route('home.index');
    }

}
