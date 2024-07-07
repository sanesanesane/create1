<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{$title }}</h1>
    <a href="{{ route('works.create') }}">作品登録</a>
    <a href="{{ route('works.index') }}">作品一覧</a>
</body>
</html>