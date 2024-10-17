<!DOCTYPE html>
<html>

<head>
    <title>作品編集</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇作品登録</h1>
        </div>

        <form method="post" action="{{ route('museums.update', $work) }}">
            @csrf
            @method('patch')

            <div class="description">
                <div class = "form-work">
                    <label>施設の名前</label><br>
                    <input type="text" name="work_name" maxlength="15"
                        value="{{ old('work_name', $work->work_name) }}"><br>
                </div>

                

                <div class="links">
                    <div class="left-link">
                        <input type="submit" value='更新'>
                    </div>
                    <div>
                        <a href="{{ route('home.index') }}">ホームへ戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>