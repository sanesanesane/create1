<!DOCTYPE html>
<html>

<head>
    <title>年代一覧</title>
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
            <h1>〇年代一覧</h1>
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
                @foreach ($ages as $age)
                    <tr>
                        <td class="number">{{ $age->age_ID }}</td>
                        <td class="name">{{ $age->age_Name }}</td>
                        
                            <td class="edit">
                                <a href="{{ route('ages.edit', $age->age_ID) }}" class="button-edit">編集
                            </a>

                            <td class="delete">
                            <form action="{{ route('ages.delete', $age->age_ID) }}" method="post">
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
        {{ $ages->links() }}
        <div>
            <a href="{{ route('dashboard.title') }}" class="button-back">戻る</a>
        </div>
    </div>
</body>
</html>
