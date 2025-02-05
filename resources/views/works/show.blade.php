<!DOCTYPE html>
<html>

<head>
    <title>作品詳細</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div class="header-row">
            <h1>〇作品詳細</h1>
            <a href="{{ route('works.edit', $work) }}" class="button-store">編集</a>
        </div>
        <div class="description">
            <div>
                <h2>
                    〇作品名
                </h2>
                <p>
                    {{ $work->work_name }}
                </p>
            </div>
            <div>
                <h3>
                    〇詳細
                </h3>
                <p>
                    {{ $work->work_description }}
                </p>
            </div>
            <div>
                <h4>
                    〇作者
                </h4>
                <p>
                    {{ $work->work_artist }}
                </p>
            </div>
            <div>
                <h4>
                    〇所蔵美術館
                </h4>
                <p>
                    {{ $work->museum->museum_Name }}
                </p>
            </div>
            <div>
                <h4>
                    〇作品科目
                </h4>
                <p>
                    {{ $work->subject->subject_Name }}
                </p>
            </div>
            <div>
                <h4>
                    〇地域<br>
                </h4>
                <p>
                    {{ $work->country->country_Name }}
                </p>
            </div>
            <div>
                <h4>
                    〇年代<br>
                </h4>
                <p>
                    {{ $work->age->age_Name }}
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
        </div>
    </div>

</body>

</html>
