<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\TestMail; 
use Illuminate\Support\Facades\Mail; 

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
        $user = new User();//新しいユーザーを定義する。
        $user_email =$request->input('email');//e-mailの入力（同じユーザーをはじく用）
        $user->name = $request->input('name');//名前の入力を行う。
        $password = $request->input('password');//パスワード変数を定義する。
        $password_confirmation = $request->input('password_confirmation');//確認用パスワードの変数を定義する。

        //〇名前を全角文字のみにする。
        if (preg_match('/[^\x{3000}-\x{FF9F}]/u', $user->name)) 
        {
            return back()->withErrors(['name' => '全角文字のみ使用してください。']);
        }

        //〇数字と記号の使用を制限する。
        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $user->name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        //〇文字数を設定する。
        if (mb_strlen($user->name) > 16)
         {
            return back()->withErrors(['name' => '文字数は全角16文字以内で入力してください。']);
        }
        
        //〇同じユーザーを弾く
        if (User::where('email', $user_email)->exists()) 
        {
            return back()->withErrors(['email' => 'こちらのユーザーは既に登録されています。']);
        }
        
        //〇正しくない形式のメールアドレスを弾く
        if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i', $user_email)) 
        {
            return back()->withErrors(['email' => '正しいメールアドレスを入力してください。']);
        }

        //〇パスワードの設定
        if (strlen($password) < 8 || strlen($password) > 16) 
        {
        return back()->withErrors(['password' => 'パスワードは8文字以上16文字以下で入力してください。']);
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            return back()->withErrors(['password' => 'パスワードは英数字のみで入力してください。']);
        }
        //〇パスワードと確認用パスワードが一致しているか
        if ($password !== $password_confirmation) {
            return back()->withErrors(['password' => 'パスワードが一致しません。']);
        }

        $user->password = bcrypt($password);//パスワードの暗号化
        $user->email = $user_email;//変数$user_emailをユーザーの$emailに定義する。

        $user->save();//ユーザーの保存

        return redirect()->route('home.index');
    }

    //〇ユーザーログインのコード
    public function login(Request $request)
    {
        $email = $request->input('email');//e-mailの入力をemailと変数を定義。
        $password = $request->input('password');//パスワードの入力をpasswardと変数を定義。

        //emailとpasswardが一致しているか確認。一致している場合はログイン処理を行う。
        if(Auth::attempt(['email' => $email , 'password' => $password]))
        {
            Auth::user()->name;
            return redirect()->route('home.index');
        }

        //emailとpasswardが一致していない場合
        else
        {
            return back()->withErrors(['login' => 'ID又はパスワードが違います。']);
        }
    }

    //〇ログインページへ遷移
    public function loginpage ()
    {
        return view('users.test');

    }

    //〇ユーザー詳細画面へ遷移
    public function show()
    {
        $user = Auth::user();//現在ログイン中のユーザーを選択。
    
        return view('users.show', compact('user'));
    }

    //〇ユーザーのログアウト処理
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

    //〇ユーザーの編集
    public function update(Request $request, User $user)
    {
        $user_email =$request->input('email');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        
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


        if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i', $user_email)) 
        {
            return back()->withErrors(['email' => '正しいメールアドレスを入力してください。']);
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

    //〇ユーザーパスワード変更を再依頼ページ
    public function mail ()
    {
        return view('users.mail');
    }
    
    //〇ユーザから管理者へパスワード変更依頼メールを送信する。
    public function send (Request $request)
    {
    $data = [
        'title' => 'パスワード再設定のご案内',
        'message' => '以下のURLからパスワードの再設定を行ってください。'
    ];

    $email = $request->input('email');

    Mail::to($email)->send(new TestMail($data));
        return view('users.title');
    }
}
