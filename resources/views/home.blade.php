<!DOCTYPE html>
<html>

<head>
    <title>ホームページ</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 20px;">タイトル画面</h1>
            <a href="{{ route('users.show') }}">ユーザー詳細</a>
        </div>
        <div>
            <div class="description">
                <h3>〇登録メニュー</h3>
                <div class="title">
                    <a href="{{ route('works.create') }}"class="button-store">作品の登録</a>
                    <p>読んだ本や鑑賞した作品を登録できます。</p>
                </div>
                <div class="title">
                    <a href="{{ route('dashboard.menu') }}"class="button-store">タグの登録</a>
                    <p>作品の登録に使用するタグの設定をします。</p>
                </div>
                <div class="title">
                    <a href="{{ route('museums.create') }}"class="button-store">施設の登録</a>
                    <p>美術館や博物館などの施設を登録できます。</p>
                </div>
            </div>
            <div>
            </div>
            <div class="description">
                <h3>〇一覧メニュー</h3>
                <div class="title">
                    <a href="{{ route('works.index') }}" class="button-link">作品一覧</a>
                    <p>読んだ本や鑑賞した作品を確認できます。</p>
                </div>
                <div class="title">
                    <a href="{{ route('dashboard.title') }}"class="button-link">タグ一覧</a>
                    <p>登録したタグを確認できます。</p>
                </div>
                <div class="title">
                    <a href="{{ route('museums.index') }}"class="button-link">美術館一覧</a>
                    <p>登録した施設を確認できます。</p>
                </div>
                <div>
                    <a href="{{ route('museums.site') }}"class="button-link">美術館地図（テスト）</a>
                </div>
            </div>
</body>

</html>
