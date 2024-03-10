<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//以下のモデルを使用
use App\Models\Book;

class BookController extends Controller
{

        // 本の作成フォームを表示
    public function create()
    {
        return view('books.create');
    }

    // 本をデータベースに保存
    public function store(Request $request)
    {
        // 保存ロジック
        return redirect()->route('books.index');
    }

    // 本の一覧を表示
    public function index()
    {
        // 本一覧取得ロジック
        return view('books.index');
    }

    // 本を削除
    public function delete($id)
    {
        // 削除ロジック
        return redirect()->route('books.index');
    }

    // 本の編集フォームを表示
    public function edit($id)
    {
        // 編集データ取得ロジック
        return view('books.edit');
    }

}

