<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\HtmlString;

use App\Models\Age;

class AgeController extends Controller
    {

        // 科目の作成フォームを表示
        public function create()
        {
            return view('ages.create');
        }

        public function store(Request $request)
        {
            //変数ageを定義
            $age = new Age;
            //入力した名前をage_nameとして定義する。
            $age_name = $request->input('age_name');
            //空白があった場合、空白を削除する。
            $age_name = trim($age_name);
            //全角に自動変換する
            $age_name = mb_convert_kana($age_name, 'ASKV', 'UTF-8');

            //〇バリデーション
            //文字数を15文字までにする。
            if(mb_strlen($age_name, 'UTF-8') > 15)
            {
                return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
            }

            //既に登録している場合
            if (Age::where('age_Name', $age_name)->exists()) 
            {
                return back()->withErrors(['name' => 'この年代は既に登録されています。']);
            }

            $age->age_Name =$age_name;//入力した内容を定義
            $age->user_id = auth()->id();//ログイン中のユーザーにuser_idを定義
            $age->save(); //保存

            return redirect()->route('ages.create')->with('success', '作品が登録されました');
        }

        // 科目の一覧を表示
        public function index()
        {
            $user_id = auth()->id();//user_idをログイン中のユーザーに定義
            //表示する内容
            $ages = Age::where('user_id', $user_id)//userを限定
            ->where('age_Name', '!=', '削除済み')//名前が削除済みのものを除く
            ->where('age_Name', '!=', '年代を選択してください。')//名前が年代を選択してくださいと書いてあるものを除く
            ->simplePaginate(5); //ぺジネーション5個

            return view('ages.index',compact('ages'));
        }

        public function delete(Request $request, $age_ID)
        {
            $age = Age::where('age_ID', $age_ID)->first();//$age_IDが一致しているものをしらべる
            if ($age) 
            {
                $age->age_Name = '削除済み';//名前を削除済みに変更する
                $age->update();//保存
        
                return redirect()->route('ages.index')->with('success', 'データを削除しました。');
            }
            return redirect()->route('ages.index')->with('error', 'データが見つかりません。');
        }
        
        public function edit(Age $age)
        {
            //ページへ遷移
            return view ('ages.edit' , compact('age'));
        }
        
        public function update(Request $request,Age $age)
        {
            //編集（保存とコードは同意）
            $age_name =$request->input('age_name');
            $age->age_Name =$age_name;
            $age_name = trim($age_name);
            $age_name = mb_convert_kana($age_name, 'ASKV', 'UTF-8');

            if(mb_strlen($age_name, 'UTF-8') > 15)
            {
                return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
            }

            if (Age::where('age_Name', $age_name)->exists()) 
            {
                return back()->withErrors(['name' => 'この年代は既に登録されています。']);
            }
    
            $age->save();
    
            return redirect()->route('ages.index')->with('success', '作品が更新されました');
        }
    
    }
    

