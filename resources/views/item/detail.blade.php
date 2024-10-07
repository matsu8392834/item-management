@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品詳細</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">

                        <thead>

                            @foreach ($items as $item)

                                <tr> <th class="th bg-primary">ID</th> <td class="td table-bordered bg-light">{{ $item->id }}</td> </tr>
                                <tr> <th class="th bg-primary">ユーザーID</th> <td class="td table-bordered bg-light">{{ $item->user_id }}</td> </tr>
                                <tr> <th class="th bg-primary">商品名</th> <td class="td table-bordered bg-light">{{ $item->name }}</td> </tr>
                                <tr> <th class="th bg-primary">価格</th> <td class="td table-bordered bg-light">{{ $item->price }}</td> </tr>
                                <tr> <th class="th bg-primary">種別</th> <td class="td table-bordered bg-light">

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

                                </td> </tr>
                                <tr> <th class="th bg-primary">詳細</th> <td class="td table-bordered bg-light">{{ $item->detail }}</td> </tr>
                                <tr> <th class="th bg-primary">登録日時</th> <td class="td table-bordered bg-light">{{ $item->created_at }}</td> </tr>
                                <tr> <th class="th bg-primary">更新日時</th> <td class="td table-bordered bg-light">{{ $item->updated_at }}</td> </tr>
                                <tr> <th class="th bg-primary">販売状態</th> <td class="td table-bordered bg-light">

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

                                </td> </tr>

                            @endforeach

                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop
