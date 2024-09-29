<!DOCTYPE html>
<html>

<head>
    <title>登録メニュー</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇登録メニュー</h1>
        </div>
        <div class="description">
            <div>
                <a href="{{ route('subjects.create') }}"class="button-store-tag">科目の登録</a>
            </div>
            <div>
                <a href="{{ route('countries.create') }}"class="button-store-tag">地域の登録
                </a>
            </div>
            <div>
                <a href="{{ route('ages.create') }}"class="button-store-tag">年代の登録</a>
            </div>
        </div>

            <div>
                <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
            </div>

</body>

</html>
