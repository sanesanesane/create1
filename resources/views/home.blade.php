<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{$title }}</h1>
    <a href="{{ route('works.create') }}">作品登録</a>
    <a href="{{ route('works.index') }}">作品一覧</a>
    <a href="{{ route('books.create')}}">本登録</a>
    <a href="{{ route('dashboard.menu')}}">その他管理用登録画面</a>
    <a href="{{ route('dashboard.title')}}">その他管理用一覧画面</a>
    <div>
        <a href="{{ route('museums.create')}}">美術館登録</a>
    </div>
    <a href="{{ route('users.create')}}">テストユーザー登録</a>
    <a href="{{ route('users.loginpage')}}">テストユーザーログイン</a>
</body>
</html>