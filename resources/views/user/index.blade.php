
@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')

    <div id="app" class="p-5">
        <!-- 一覧表示するブロック ① -->
         <h3>ユーザー一覧</h3>
         @if(session('updatemessage'))
	    <div class="alert alert-success">
		{{ session('updatemessage') }}
	    </div>
        @endif
        @if(session('deletemessage'))
	    <div class="alert alert-danger">
		{{ session('deletemessage') }}
	    </div>
        @endif   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>更新日時</th>
                        <th>権限</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>@if($user->role==0) 利用者
                            @else 管理者 @endif</td>
                        <td><a href="/users/edit/{{$user->id}}">編集</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

@stop

@section('css')
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@stop