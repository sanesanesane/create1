<html>
    <h1>〇地域</h1>
<table>
    <thead>
        <tr>
            <th>番号</th>
            <th>名前</th>
        </tr>
    </thead>



    <tbody>
        @foreach ($countries as $country)
        <tr>
            <td>{{ $country->country_ID }}</td>
            <td>{{ $country->country_Name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>