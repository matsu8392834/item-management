
@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
    <h1>ホーム画面</h1>
@stop

@section('content')

    <div class="item-category">
        <div class="category">
            <h2>ジャンル</h2>
        
            <div class="list">
                <ul>
                    <li>スポーツ</li>
                    <li>食品・ドリンク</li>
                    <li>日用品・キッチン用品</li>
                    <li>家電・TV・カメラ</li>
                    <li>ゲーム・音楽・書籍</li>
                    <li>ファッション</li>
                    <li>家具・インテリア</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container1">
        <div class="item-ranking">
            <h2>人気商品ランキング</h2>
        </div>
            <div class="box">
                <div class="image"><img src="/images/1.jpg" alt=""></div>
                <div class="image"><img src="/images/2.jpg" alt=""></div>
                <div class="image"><img src="/images/3.jpg" alt=""></div>
                <div class="image"><img src="/images/4.jpg" alt=""></div>
            </div>
    </div>

    <div class="container2">
        <div class="recommendation">
            <h2>あなたにおすすめの商品</h2>
        </div>
            <div class="box2">
                <div class="image"><img src="/images/5.jpg" alt=""></div>
                <div class="image"><img src="/images/6.jpg" alt=""></div>
                <div class="image"><img src="/images/7.jpg" alt=""></div>
                <div class="image"><img src="/images/8.jpg" alt=""></div>
            </div>
    </div>

    <div class="container3">
        <div class="time-sale">
            <h2>タイムセール</h2>
        </div>
            <div class="box3">
                <div class="image"><img src="/images/5.jpg" alt=""></div>
                <div class="image"><img src="/images/6.jpg" alt=""></div>
                <div class="image"><img src="/images/7.jpg" alt=""></div>
                <div class="image"><img src="/images/8.jpg" alt=""></div>
            </div>
    </div>

    <div class="container4">
        <div class="pick-up">
            <h2>ピックアップ商品</h2>
        </div>
            <div class="box4">
                <div class="image"><img src="/images/5.jpg" alt=""></div>
                <div class="image"><img src="/images/6.jpg" alt=""></div>
                <div class="image"><img src="/images/7.jpg" alt=""></div>
                <div class="image"><img src="/images/8.jpg" alt=""></div>
            </div>
    </div>

@stop

@section('css')

<link rel="stylesheet" href="{{ asset('/css/style.css') }}">

@stop

@section('js')

@stop