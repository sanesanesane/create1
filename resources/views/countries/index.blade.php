<!DOCTYPE html>
<html>
<head>
    <title>地域一覧</title>
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
            <h1>〇地域</h1>
        </div>
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
        <table class="table-list">
            <thead>
                <tr>
                    <th class="number">番号</th>
                    <th class="name">名前</th>
                    <th class="edit">編集</th>
                    <th class="delete">削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td class="number">{{ $country->country_ID }}</td>
                        <td class="name">{{ $country->country_Name }}</td>
                        <td class="edit">
                                <a href="{{ route('countries.edit', $country->country_ID) }}" class="button-edit">編集</a>

                        <td class="delete">
                            <form action="{{ route('countries.delete', $country->country_ID) }}" method="post">
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
        {{ $countries->links() }}
        <div>
            <a href="{{ route('dashboard.title') }}" class="button-back">戻る</a>
        </div>
    </div>
</body>
</html>
