<!DOCTYPE html>
<html>
<head>
    <title>年代管理</title>
</head>
<body>
    <h1>〇年代</h1>

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
                <th>削除</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($ages as $age)
            <tr>
                <td>{{ $age->age_ID }}</td>
                <td>{{ $age->age_Name }}</td>
                <td>
                <form action="{{route('ages.delete', $age->age_ID)}}" method = 'post' >
                    @csrf
                    @method('patch')
                    <p>
                        <input type="submit" value="削除">
                    </p>
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
