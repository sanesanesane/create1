<!DOCTYPE html>
<html>

<head>
    <title>施設登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇施設登録</h1>
        </div>

        <form method="post" action="{{ route('museums.store') }}">
            @csrf
            <div class="description">
                <div class = "form-work">
                    <label>・美術館名</label><br>
                    <input type='text' name="museum_name" value="" placeholder="施設名"><br>
                </div>
                <div class = "form-work">
                    <label>・美術館内容</label><br>
                    <input type='text' name="museum_content" value="" placeholder="概要"><br>
                </div>
                <div class = "form-work">
                    <label>・所在地</label><br>
                    <input type="text" name="museum_api" maxlength="40" value="" placeholder="住所"><br>
                </div>
                <div class="links">
                    <div class="left-link">
                        <button class="button-store">登録</button>
                    </div>
                    <div class="right-link">
                        <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
