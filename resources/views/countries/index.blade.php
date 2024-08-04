<html>
    <head>
        <title>地域一覧</title>
    </head>
    <body>
    <h1>〇地域</h1>
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
        @foreach ($countries as $country)
        <tr>
            <td>{{ $country->country_ID }}</td>
            <td>{{ $country->country_Name }}</td>
            <td>
                <form action="{{ route('countries.delete', $country->country_ID) }}" method="post">
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