<html>
<h1>〇作品一覧</h1>

<form method="GET" action="{{ route('works.index') }}">
    <input type="text" name="search" placeholder="検索キーワードを入力" value="{{ request('search') }}">
    <button type="submit">検索</button>
</form>

<table>
    <thead>
        <tr>
            <th>番号</th>
            <th>名前</th>
            <th>科目</th>
            <th>作者</th>
            <th>地域</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($works as $work)

        <tr>
            <td>{{ $work->work_id }}</td>
            <td>{{ $work->work_name }}</td>
            <td>{{ $work->subject->subject_Name }}</td> 
            <td>{{ $work->work_artist }}</td>
            <td>{{ $work->country->country_Name }}</td>
        </tr>

        @endforeach

</table>
<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>


</html>