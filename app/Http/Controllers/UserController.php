<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //ユーザー登録ページに遷移
    public function create()
    {
        return view('users.create');
    }

    //ユーザー登録コード
    public function register(Request $request)
    {
        $user = new User();//新しいユーザーを作成
        $user_email =$request->input('email');//e-mailの入力（同じユーザーをはじく用）
        $user->name = $request->input('name');//名前の入力
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $user->email = $request->input('email');//e-mailの入力


        if (preg_match('/[^\x{3000}-\x{FF9F}]/u', $user->name)) 
        {
            return back()->withErrors(['name' => '全角文字のみ使用してください。']);
        }

        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $user->name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        if (mb_strlen($user->name) > 16)
         {
            return back()->withErrors(['name' => '文字数は全角16文字以内で入力してください。']);
        }

        if (User::where('email', $user_email)->exists()) 
        {
            return back()->withErrors(['email' => 'こちらのユーザーは既に登録されています。']);
        }

        if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i', $user_email)) 
        {
            return back()->withErrors(['email' => '正しいメールアドレスを入力してください。']);
        }

        if (strlen($password) < 8 || strlen($password) > 16) 
        {
        return back()->withErrors(['password' => 'パスワードは8文字以上16文字以下で入力してください。']);
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            return back()->withErrors(['password' => 'パスワードは英数字のみで入力してください。']);
        }

        if ($password !== $password_confirmation) {
            return back()->withErrors(['password' => 'パスワードが一致しません。']);
        }

        $user->password = bcrypt($password);//パスワードの暗号化
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
