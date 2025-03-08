<!DOCTYPE html>
<html>

<head>
    <title>ようこそ！</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">

</head>

<body>
    //枠を作ります。
    <div class="container">
        <div>
            <h1>〇作品登録メモへようこそ！</h1>
        </div>
        //枠の中に作る枠
        <div class="description">
            <h2>・説明</h2>
            <p>このアプリでは、行きたい博物館や美術館などの施設を登録出来ます。科目や年代ごとに情報を整理出来るため、体系的に知識を深めるのに役立つ機能が特徴です。</p>
        </div>

        <div class="links">
            <div class="left-link">
                <p>※初めての方はこちら</p>
                <a href="{{ route('users.create') }}" class="button-link">登　録　</a>
            </div>

            <div class="right-link">
                <p>※既に登録している方</p>
                <a href="{{ route('users.loginpage') }}" class="button-link">ログイン</a>
            </div>
        </div>
    </div>
</body>

</html>
