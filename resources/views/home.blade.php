<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{$title }}</h1>
    <a href="{{ route('works.create') }}">美術館登録</a>
    <a href="{{ route('museums.index') }}">美術館一覧</a>
</body>
</html>