@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form action="/items/add" method="POST">
                    @csrf

                    <a href="/items" class="back">一覧画面に戻る</a>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="商品名">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{old('price')}}" placeholder="価格">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" id="type" name="type" placeholder="種別">
                                <option value=""  @selected(old('type')=="")></option>
                                <option value="1" @selected(old('type')=="1")>スポーツ用品</option>
                                <option value="2" @selected(old('type')=="2")>食料品</option>
                                <option value="3" @selected(old('type')=="3")>日用品</option>
                                <option value="4" @selected(old('type')=="4")>家電製品</option>
                                <option value="5" @selected(old('type')=="5")>エンタメグッズ</option>
                                <option value="5" @selected(old('type')=="5")>ファッション</option>
                                <option value="5" @selected(old('type')=="5")>インテリア用品</option>
                                <option value="5" @selected(old('type')=="5")>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{old('detail')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">販売状態</label>
                            <input type="radio" class="form-control" id="statud" name="status" value="1" @checked(old('status')=="1") placeholder="販売状態"> 在庫あり
                            <input type="radio" class="form-control" id="statud" name="status" value="2" @checked(old('status')=="2") placeholder="販売状態"> 在庫なし
                            <input type="radio" class="form-control" id="statud" name="status" value="3" @checked(old('status')=="3") placeholder="販売状態"> 予約受付中
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
