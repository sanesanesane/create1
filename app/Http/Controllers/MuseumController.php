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
            $subjects = Subject::where('user_id', auth()->id())->get();
            $countries = Country::where('user_id', auth()->id())->get();
            $ages = Age::where('user_id', auth()->id())->get();
    
    
            return view('museums.create', compact('subjects','countries','ages')); 
        }
    
        // 本をデータベースに保存
        public function store(Request $request)
        {
            $museums = new Museum();
            $museums->user_id = auth()->id(); //外部キー関連
            $museums->subject_id = $request->input('subject_id');
            $museums->country_id = $request->input('country_id');
            $museums->age_id = $request->input('age_id');
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
