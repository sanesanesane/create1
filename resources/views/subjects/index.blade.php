<html>
    <h1>〇科目一覧</h1>
<table>
    <thead>
        <tr>
            <th>番号</th>
            <th>名前</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($subjects as $subject)
        <tr>
            <td>{{ $subject->subject_ID }}</td>
            <td>{{ $subject->subject_Name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>
</html>