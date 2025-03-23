<!DOCTYPE html>
<html>

<head>
    <title>パスワード再発行依頼ページ</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇パスワード変更依頼</h1>
        </div>
        <div class="description">
            <div class = "form">
                <div>
                    <label for="email">メールアドレス</label><br>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <p>上記のメールアドレス宛にパスワード変更画面のURLを送信します。</p>
                </div>
                <div class="links">
                    <div class="left-link">
                        <button class="button-link">送信</button>
                    </div>
                    <div class="right-link">
                        <a href="{{ route('users.title') }}"class="button-back">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
