<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Country;
use App\Models\Age;
use App\Models\Museum;
use Symfony\Component\Mime\Test\Constraint\EmailSubjectContains;
use Illuminate\Support\HtmlString;
use App\Person;

class MuseumController extends Controller
{
    
    public function create()
    {
        // 本の作成フォームへ遷移
        return view('museums.create');
    }

    public function store(Request $request)
    {
        $museums = new Museum();//変数museumsを定義
        $museums_name = $request->input('museum_name');//変数museums_nameをmuseum_nameフォームに入力した内容に定義。
        $museums_API  = $request->input('museum_api');//変数museums_apiをmuseum_apiフォームに入力した内容に定義。
        //変数museums_nameについて空白があった場合、空白を削除するし全角に自動変換する。
        $museums_name = trim($museums_name);
        $museums_name = mb_convert_kana($museums_name, 'ASKV', 'UTF-8');
        //変数museums_apiについて空白があった場合、空白を削除するし全角に自動変換する。
        $museums_API  = trim($museums_API);
        $museums_API  = mb_convert_kana($museums_API, 'ASKV', 'UTF-8');
        //〇バリデーション
        //変数museums_nameについて

        //既に登録している場合
        if (Museum::where('museum_Name', $museums_name)->exists()) {
            return back()->withErrors(['name' => 'この施設は既に登録されています。']);
        }
        //文字数を15文字までにする
        if (mb_strlen($museums_name, 'UTF-8') > 15) {
            return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
        }
        //記号と数字を制限する。
        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $museums_name)) {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        $museums->museum_Name = $museums_name;//変数museums_nameをテーブルに挿入
        $museums->museum_API = $museums_API;//変数museums_apiをテーブルに挿入
        $museums->museum_Content = $request->input('museum_content');//museum_Contentカラムにフォーム入力した内容に定義。
        $museums->user_id = auth()->id();$age->user_id = auth()->id();//ログイン中のユーザーにuser_idを定義
        $museums->save();//保存

        return redirect()->route('museums.index');
    }

    public function index(Request $request)
    {
        $user_id = auth()->id();//ログイン中のユーザーにuser_idを定義

        $query = Museum::where('museum_Name', '!=', '削除済み')//名前が削除済みのものを除く
                       ->where('user_id', $user_id);//userを限定

        $search = $request->input('search');//検索用の変数
        $search = trim($search);//空白があった場合、空白を削除する

        if ($search)//変数$searchに入力があった場合
        {
            $query->where(function ($q) use ($search) //変数searchを使えるようにする。
            {
                $q->where('museum_API', 'LIKE', "%$search%");//'museum_API'について変数searchと部分一致している内容のみを表示する。
            });
        }

        $museums = $query->simplePaginate(6);//ぺジネーションについて

        return view('museums.index', compact('museums'));
    }

    public function show($museum)
    {
        $museum = Museum::where('museum_ID', $museum)->firstOrFail();

        return view('museums.show', compact('museum'));
    }

    // 本を削除
    public function delete(Museum $museums)
    {
        $museums = Museum::findOrFail($museums);
        $museums->delete();

        return redirect()->route('museums.index');
    }

    // 本の編集フォームを表示
    public function edit(Museum $museums, Request $request)
    {
        $museums->update($request->all()); // 入力されたものをすべて取得
        // 編集データ取得ロジック
        return view('museums.edit', compact('museums', 'subjects', 'countries', 'ages'));
    }

    public function site() // テスト用
    {
        $site = Museum::where('museum_ID', 2)->value('museum_API');

        return view('museums.site', compact('site')); // 変数を指定。
    }
}
