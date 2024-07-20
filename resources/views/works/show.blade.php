<h1>〇作品詳細</h1>
<p>
    〇作品名<br>
    {{$work ->work_name}}
</p>

<p>
    〇作者<br>
    {{$work ->work_artist}}
</p>

<p>
    〇詳細<br>
    {{$work ->work_description}}
</p>
<p>
    〇所蔵美術館<br>
    {{$work ->museum->museum_Name}}
</p>

<p>
    〇作品科目<br>
    {{$work ->subject->subject_Name }}
</p>

<p>
    〇地域<br>
    {{$work ->country->country_Name }}
</p>

<p>
    〇年代<br>
    {{$work ->age->age_Name}}
</p>

<div class="text-right">
    <a href="{{ route ('works.edit',$work)}}">編集</a>
<div>

<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>


