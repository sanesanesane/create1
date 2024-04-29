<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//以下のモデルを使用
use App\Models\Book;
use App\Models\Subject;
use Symfony\Component\Mime\Test\Constraint\EmailSubjectContains;
use Illuminate\Support\HtmlString;

class BookController extends Controller
{

        // 本の作成フォームを表示
    public function create()
    {
        $subjects = Subject::where('user_id', auth()->id())->get();

        return view('books.create', compact('subjects')); 
    }

    // 本をデータベースに保存
    public function store(Request $request)
    {
        $books = new Book();
        $books->user_id = auth()->id(); //外部キー関連
        $books->subject_id = $request->input('subject_id');
        $books->save();

        return redirect()->route('books.index');
    }

    // 本の一覧を表示
    public function index()
    {
        $userId = auth()->id();
        $query = Book::where('user_id', $userId);
        $subjects = Subject::where('user_id', auth()->id())->get();

        return view('books.index',compact('books','subjects'));
    }

    // 本を削除
    public function delete(Book $books)
    {
        $books = Book::findOrFail($books);
        $books->delete();

        return redirect()->route('books.index');
    }

    // 本の編集フォームを表示
    public function edit(Book $books, Request $request)
    {

        $books->update($request->all()); //入力されたものをすべて取得
        // 編集データ取得ロジック
        return view('books.edit',compact('books','subjects'));
    }

}

