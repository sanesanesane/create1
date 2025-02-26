<!DOCTYPE html>
<html>
<head>
    <title>作品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
    <script>
    function EVENT3(event)//deleteはJSの変数に該当するために使用不可。
    {
        event.preventDefault(); // 確認した後に削除させるために必要！
        if (confirm("本当に削除しますか？")) 
        {
        event.target.closest("form").submit(); // submitを探して実行する。
        }
    }
    </script>
</head>

<body>
    <div class="container">
        <div>
    <h2>〇作品一覧</h2>
        </div>
    <form method="GET" action="{{ route('works.index') }}" class="form-search">
        <input type="text" name="search" placeholder="名前を入力" value="{{ request('search') }}" class="form-search" required>
        <button type="submit" class="button-search">検索</button>
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



    <table class="table-works">
        <thead>
            <tr>
                <th class="number">番号</th>
                <th class="name">名前</th>
                <th class="subject">科目</th>
                <th class="artist">作者</th>
                <th class="delete">削除</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($works as $work)
                <tr>
                    <td class="number"><a
                            href="{{ route('works.show', ['work' => $work->work_id]) }}">{{ $work->work_id }}</a></td>
                    <td class="name">{{ $work->work_name }}</td>
                    <td class="subject">{{ $work->subject->subject_Name }}</td>
                    <td class="artist">{{ $work->work_artist }}</td>
                    <td class="delete">
                        <form action="{{ route('works.delete', $work->work_id) }}" method="post">
                            @csrf
                            <p>
                                <input type="submit" value="削除" class="button-delete" onclick="EVENT3(event)">
                            </p>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $works->links() }}
    <div>
    <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
    </div>
</body>

</html>
