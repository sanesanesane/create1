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
    
        // 本をデータベースに保存
        public function store(Request $request)
        {
            $museums = new Museum();
            $museums -> museum_Name =$request->input('museum_name');
            $museums -> museum_Content =$request->input('museum_content');
            $museums -> museum_API =$request->input('museum_api');
            $museums->save();
            
            return redirect()->route('museums.index');
        }
    
        // 本の一覧を表示
        public function index()
        {
            $userId = auth()->id();
            $query = Museum::where('user_id', $userId);
            $subjects = Subject::where('user_id', auth()->id())->get();
            $countries = Country::where('user_id', auth()->id())->get();
            $ages = Age::where('user_id', auth()->id())->get();
    
            return view('museums.index',compact('museums','subjects','countries','ages'));
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
}
