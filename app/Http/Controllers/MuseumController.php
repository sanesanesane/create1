<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Country;
use App\MOdels\Age;
use App\Models\Museum;
use Symfony\Component\Mime\Test\Constraint\EmailSubjectContains;
use Illuminate\Support\HtmlString;


class MuseumController extends Controller
{
        // 本の作成フォームを表示
        public function create()
        {
    
            return view('museums.create');
        }
    
        // 施設をデータベースに保存
        public function store(Request $request)
        {
            $museums = new Museum();
            $museums_name = $request->input('museum_name');
            $museums_API  = $request->input('museum_api');


            $museums_name = trim($museums_name);
            $museums_name = mb_convert_kana($museums_name, 'ASKV', 'UTF-8');

            $museums_API  = trim($museums_API);
            $museums_API  = mb_convert_kana($museums_API, 'ASKV', 'UTF-8');

            if (Museum::where('museum_Name', $museums_name)->exists()) 
            {
                return redirect()->route('museums.index')->with('error',"この施設は既に登録されています。");
            }

            if(mb_strlen($museums_name, 'UTF-8') > 15)
            {
                return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
            }

            if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $museums_name))
            {
                return back()->withErrors(['name' => '記号や数字は使用できません。']);
            }

            if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $museums_API))
            {
                return back()->withErrors(['API' => '記号や数字は使用できません。']);
            }

            $museums -> museum_Name = $museums_name;
            $museums -> museum_API =$museums_API;
            $museums -> museum_Content =$request->input('museum_content');

            $museums->user_id = auth()->id();

            $museums->save();
            
            return redirect()->route('museums.index');
        }
    
            public function index(Request $request)
{
    $user_id = auth()->id(); 

    $query = Museum::where('museum_Name', '!=', '削除済み')
    ->where('user_id', $user_id);


    $search = $request->input('search');
    $search = trim($search);

    if ($search) {
        $query->where(function($q) use ($search)
         {
            // 内部クエリを作成
            $q->where('museum_API', 'LIKE', "%$search%");
        });
    }

    $museums = $query->paginate(10);

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
            $books = Museum::findOrFail($museums);
            $books->delete();
    
            return redirect()->route('museums.index');
        }
    
        // 本の編集フォームを表示
        public function edit(Museum $museums, Request $request)
        {
    
            $museums->update($request->all()); //入力されたものをすべて取得
            // 編集データ取得ロジック
            return view('museums.edit',compact('museums','subjects','countries','ages'));
        }

        public function site()//テスト用
{
    $site = Museum::where('museum_ID', 2)->value('museum_API');

   
    return view('museums.site', compact('site'));//変数を指定。
}


}
