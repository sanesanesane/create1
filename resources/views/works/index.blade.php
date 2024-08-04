<html>
<head>
<h1>作品一覧</h1>
</head>

<body>
    <h2>〇作品</h2>
<form method="GET" action="{{ route('works.index') }}">
    <input type="text" name="search" placeholder="検索キーワードを入力" value="{{ request('search') }}">
    <button type="submit">検索</button>
</form>

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
            <th>科目</th>
            <th>作者</th>
            <th>地域</th>
            <th>編集</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($works as $work)

        <tr>
            <td><a href="{{ route('works.show', ['work' => $work->work_id]) }}">{{ $work->work_id }}</a></td>
            <td>{{ $work->work_name }}</td>
            <td>{{ $work->subject->subject_Name }}</td> 
            <td>{{ $work->work_artist }}</td>
            <td>{{ $work->country->country_Name }}</td>
            <td>
                <form action="{{ route('works.delete', $work->work_id) }}" method="post">
                @csrf
                <p>
                    <input type="submit" value="削除">
                </p>
            </form>
            </td>
        </tr>

        @endforeach
    </tbody>

</table>
<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>
</body>
</html>