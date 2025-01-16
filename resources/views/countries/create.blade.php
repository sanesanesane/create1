<!DOCTYPE html>
<html>
<head>
    <title>地域登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇地域登録</h1>
        </div>
        <form action="{{ route('countries.store') }}" method="POST">
            @csrf
            <div class="description">
                <div class = "form-work">
                    <label>・地域名</label><br>
                    <input type="text" name="country_name" maxlength="20" value="" placeholder="地域名" required><br>
                </div>
                @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            </div>
            <div class="links">
                <div class="left-link">
                    <button class="button-store">登録</button>
                </div>
                <div class="right-link">
                    <a href="{{ route('dashboard.menu') }}"class="button-back">戻る</a>  
                </div>
            </div>
        </form>
    </div>
</body>
</html>
