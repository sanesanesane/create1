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
            $age = new Age;
            $age_name = $request->input('age_name');

            $age_name = trim($age_name);
            $age_name = mb_convert_kana($age_name, 'ASKV', 'UTF-8');

            if(mb_strlen($age_name, 'UTF-8') > 8)
            {
                return redirect()->route('ages.index')->with('error',"最大入力文字は8文字までです。");
            }

            if (Age::where('age_Name', $age_name)->exists()) 
            {
                return redirect()->route('ages.index')->with('error',"この年代は既に登録されています。");
            }
            
            $age->age_Name =$age_name;
            $age->save(); //保存

            return redirect()->route('ages.create')->with('success', '作品が登録されました');
        }

        // 科目の一覧を表示
        public function index()
        {
            $ages = Age::where('age_Name', '!=', '削除済み')->where('age_Name', '!=', '年代を選択してください。')->get();

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
        
    
    }
    

