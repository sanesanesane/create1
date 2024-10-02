<!DOCTYPE html>
<html>

<head>
    <title>作品詳細</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇作品詳細</h1>
        </div>
        <div>
            <p>
                〇作品名<br>
                {{ $work->work_name }}
            </p>
        </div>
        <div>
            <p>
                〇作者<br>
                {{ $work->work_artist }}
            </p>
        </div>
        <div>
            <p>
                〇詳細<br>
                {{ $work->work_description }}
            </p>
        </div>
        <div>
            <p>
                〇所蔵美術館<br>
                {{ $work->museum->museum_Name }}
            </p>
        </div>
        <div>
            <p>
                〇作品科目<br>
                {{ $work->subject->subject_Name }}
            </p>
        </div>
        <div>
            <p>
                〇地域<br>
                {{ $work->country->country_Name }}
            </p>
        </div>
        <div>
            <p>
                〇年代<br>
                {{ $work->age->age_Name }}
            </p>
        </div>


        <div>
            <a href="{{ route('works.edit', $work) }}">編集</a>
        </div>

        <div>
            <a href="{{ route('home.index') }}">ホームへ戻る</a>
        </div>
    </div>

</body>

</html>
