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

            if (Age::where('age_Name', $age_name)->exists()) 
            {
                return back()->withErrors(['name' => 'この地域は既に登録されています。']);
            }

            $age->age_Name =$age_name;
            $age->user_id = auth()->id();
            $age->save(); //保存

            return redirect()->route('ages.create')->with('success', '作品が登録されました');
        }

        // 科目の一覧を表示
        public function index()
        {
            $user_id = auth()->id(); 
            $ages = Age::where('user_id', $user_id)
            ->where('age_Name', '!=', '削除済み')
            ->where('age_Name', '!=', '年代を選択してください。')
            ->simplePaginate(5); 

            return view('ages.index',compact('ages'));
        }

        public function delete(Request $request, $age_ID)
        {
            $age = Age::where('age_ID', $age_ID)->first();
            
            if ($age) {
                $age->age_Name = '削除済み';
                $age->update();
        
                return redirect()->route('ages.index')->with('success', 'データを削除しました。');
            }
            return redirect()->route('ages.index')->with('error', 'データが見つかりません。');
        }
        
        public function edit(Age $age)
        {
            return view ('ages.edit' , compact('age'));
        
        }
        
        public function update(Request $request,Age $age)
        {

            $age_name =$request->input('age_name');
            $age->age_Name =$age_name;
            $age_name = trim($age_name);
            $age_name = mb_convert_kana($age_name, 'ASKV', 'UTF-8');
    
            $age->save();
    
            return redirect()->route('ages.index')->with('success', '作品が更新されました');
    
    
        }
    
    }
    

