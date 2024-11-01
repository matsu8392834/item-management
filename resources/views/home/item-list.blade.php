@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')

    <form class="form-inline ml-auto"  action="{{ route('item-list') }}" method="GET">
    

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
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ユーザーID</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>登録日時</th>
                                <th>更新日時</th>
                                <th>販売状態</th>
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
                                <td><a href="/home/item-detail/{{ $item->id }}">詳細</a></td>
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
@stop
