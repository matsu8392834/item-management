@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集 ユーザーID:{{$item->user_id}}</h1>
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
                <form action="{{ url('/items/update/' . $item->id ) }}" method="POST" id="edit">
                    @csrf

                    <a href="/items" class="back">一覧画面に戻る</a>

                    <div class="card-body">

                        <input type="text" class="form-control" name="id" placeholder="" value="{{old('id',$item->id)}}" hidden>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name',$item->name)}}" placeholder="商品名">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{old('price',$item->price)}}" placeholder="価格">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" id="type" name="type" placeholder="種別">
                                <option value=""  @selected($item->type=="")></option>
                                <option value="1" @selected($item->type=="1")>スポーツ用品</option>
                                <option value="2" @selected($item->type=="2")>食料品</option>
                                <option value="3" @selected($item->type=="3")>日用品</option>
                                <option value="4" @selected($item->type=="4")>家電製品</option>
                                <option value="4" @selected($item->type=="5")>エンタメグッズ</option>
                                <option value="4" @selected($item->type=="6")>ファッション</option>
                                <option value="4" @selected($item->type=="7")>インテリア用品</option>
                                <option value="5" @selected($item->type=="8")>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{old('detail',$item->detail)}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">販売状態</label>
                            <input type="radio" class="form-control" id="statud" name="status" value="1" @checked($item->status=="1") placeholder="販売状態"> 在庫あり
                            <input type="radio" class="form-control" id="statud" name="status" value="2" @checked($item->status=="2") placeholder="販売状態"> 在庫なし
                            <input type="radio" class="form-control" id="statud" name="status" value="3" @checked($item->status=="3") placeholder="販売状態"> 予約受付中
                        </div>

                    </div>

                </form>

                <div class="card-footer">
                        <div>
                            <button form="edit" type="submit" class="btn btn-primary">更新</button>
                        </div>          

                <form action="{{ url('/items/destroy/' . $item->id ) }}" method="POST">
                            @csrf
                            
                        <div>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
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
