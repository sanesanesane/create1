<!DOCTYPE html>
<html>
<head>
    <title>一覧メニュー</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>
<body>
    <div class="container">
        <div>
    <h1>〇一覧メニュー</h1>
        </div>
        <div class="description">
    <a href="{{ route('subjects.index') }}"class="button-link-tag">科目の一覧</a>
    <a href="{{ route('countries.index') }}"class="button-link-tag">地域の一覧</a>
    <a href="{{ route('ages.index') }}"class="button-link-tag">年代の一覧</a>

</div>
    <div>
        <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
    </div>

</body>
</html>
