
@extends('adminlte::page')

@section('title', 'ユーザー編集')

@section('content_header')
    <h1>ユーザー編集</h1>
@stop

@section('content')

    <div id="app" class="p-5">
    <h1>ユーザー編集フォーム</h1>
    <a href="/users" class="back">一覧画面に戻る</a>
    <form action="/users/update" method="post">
        @csrf
    <table>
        <tr>
            <th>ID</th>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <th>名前</th>
            <td><input type="text" name="name" value="{{$user->name}}"></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><input type="text" name="email" value="{{$user->email}}"></td>
        </tr>
        <tr>
            <th>権限</th>
            <td><input type="radio" name="role" value="0" @if($user->role==0) checked @endif>利用者</td>
            <td><input type="radio" name="role" value="1" @if($user->role==1) checked @endif>管理者</td>
        </tr>
    </table>
    <input type="hidden" name="id" value="{{$user->id}}">
    <button type="submit" class="btn btn-primary">更新</button></a>
    <td>
      </td>
      </td>
      <td>
      <a href="/users/delete/{{ $user->id }}" button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button></a>
    </td>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

 
 @stop

@section('css')
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@stop