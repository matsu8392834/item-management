@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
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

    <form class="form-inline ml-auto"  action="{{ route('list') }}" method="GET">
    

        <input class="form-control mr-2" type="search" placeholder="検索" aria-label="Search" name="keyword" value="{{$keyword ?? ''}}" style = "margin-left:50px " >
                
        <!-- 最低価格入力フィールド -->
        <input class="form-control mr-2" type="number" placeholder="最低価格" aria-label="Price Min" name="price_min" value="{{ request()->price_min }}">

        <!-- 最高価格入力フィールド -->
        <input class="form-control mr-2" type="number" placeholder="最高価格" aria-label="Price Max" name="price_max" value="{{ request()->price_max }}">
                
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >検索</button>
        
    </form> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>@sortablelink('id','ID')</th>
                                <th>@sortablelink('user_id','ユーザーID')</th>
                                <th>商品名</th>
                                <th>@sortablelink('price','価格')</th>
                                <th>@sortablelink('type','種別')</th>
                                <th>詳細</th>
                                <th>@sortablelink('created_at','登録日時')</th>
                                <th>更新日時</th>
                                <th>@sortablelink('status','販売状態')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($items as $item)

                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>

                                    <?php

                                        switch ($item->type) {
                                            case '1': 
                                                echo "スポーツ用品";
                                            break;
                                            case '2': 
                                                echo "食料品";
                                            break;
                                            case '3': 
                                                echo "日用品";
                                            break;
                                            case '4': 
                                                echo "家電製品";
                                            break;
                                            case '5': 
                                                echo "エンタメグッズ";
                                            break;
                                            case '6': 
                                                echo "ファッション";
                                            break;
                                            case '7': 
                                                echo "インテリア用品";
                                            break;
                                            case '8': 
                                                echo "その他";
                                            break;
                                        }

                                    ?>

                                </td>

                                <td><a href="/items/detail/{{ $item->id }}">詳細</a></td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>

                                    <?php
                                
                                        switch ($item->status) {
                                            case '1': 
                                                echo "在庫あり";
                                            break;
                                            case '2': 
                                                echo "在庫なし";
                                            break;
                                            case '3': 
                                                echo "予約受付中";
                                            break;
                                        }
                
                                    ?>
    
                                </td>

                                <td>
                                    <!-- 編集ボタン -->

                                    <form action="{{ url('/items/edit/' . $item->id ) }}" method="GET"> 
                                        <button type="submit" class=" btn-edit "> >>商品編集 </button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                    {{ $items->appends(request()->query())->links('pagination::bootstrap-5')}}

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@stop
