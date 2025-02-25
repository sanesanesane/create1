<!DOCTYPE html>
<html>

<head>
    <title>施設一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇施設一覧</h1>
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

        <div>
        <form method="GET" action="{{ route('museums.index') }}" class="form-search" >
            <input type="text" name="search" placeholder="住所一部検索" value="{{ request('search') }}" class="form-search" required>
            <button type="submit" class="button-search" >検索</button>
        </form>
        </div>

        <table class="table-museum">
            <thead>
                <tr>
                    <th class="number">番号</th>
                    <th class="name">名前</th>
                    <th class="address">住所</th>
                    <th class="delete">削除</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($museums as $museum)
                    <tr>
                        <td class="number"><a href="{{ route('museums.show', ['museum' => $museum->museum_ID]) }}">{{ $museum->museum_ID }}</a>
                        <td class="name">{{ $museum->museum_Name }}</td>
                        <td class="address">{{ $museum->museum_API}}</td>
                        <td class="delete">削除</td>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $museums->links() }}
        <div>
            <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
        </div>
    </div>
</body>

</html>
