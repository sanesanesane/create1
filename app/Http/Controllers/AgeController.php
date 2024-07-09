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


    
        // 科目の一覧を表示
        public function index()
        {
            return view('ages.index',['ages'=> $ages]);
        }

            // 科目をデータベースに保存
    public function store(Request $request)
    {
    
        $age = new Age;
        $age ->age_Name = $request->input('age_name');
        $age->save(); //保存

        return redirect()->route('ages.create')->with('success', '作品が登録されました');
    
    }
    
    }
    


