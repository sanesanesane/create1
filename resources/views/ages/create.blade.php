<!DOCTYPE html>
<html>
<head>
    <title>年代登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇年代登録</h1>
        </div>
        <form action="{{ route('ages.store') }}" method="POST">
            @csrf
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form-work">
                    <label>・年代</label><br>
                    <input type="text" name="age_name" maxlength="15" value="" placeholder="年代"><br>
                </div>
            </div>
            <div class="links">
                <div class="left-link">
                    <button class="button-store">登録</button>
                </div>
                <div class="right-link">
                    <input type="button" class="button-back" value="戻る" onclick= "history.back()">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
