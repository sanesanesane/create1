<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//以下のモデルを使用
use App\Models\Book;

class BookController extends Controller
{
    public function create()
    {
        $books = Book::all(); //本の一覧を取得。
        
    }
}
