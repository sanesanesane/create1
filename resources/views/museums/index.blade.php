<html>
    <head>
        <title>施設一覧</title>
    </head>
    <body>
    <h1>〇施設一覧</h1>

        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 成功メッセージの表示 -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- 一般的なエラーメッセージの表示 -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<table>
    <thead>
        <tr>
            <th>番号</th>
            <th>名前</th>
            <th>編集</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($museums as $museum)
        <tr>
            <td><a href="{{ route('museums.show', ['museum' => $museum->museum_ID ]) }}">{{ $museum->museum_ID  }}</a>
            <td>{{ $museum->museum_Name }}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>
    </body>
</html>