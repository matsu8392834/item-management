<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;


class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.list', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|string|max:100',
                'price' => 'required|integer',
                'type' => 'required|integer',
                'detail' => 'required|string|max:500',
                'status' => 'required|integer',
    
            ],[
    
                'name.required'=>'商品名は必須入力です',
                'price.required'=>'価格は必須入力です',
                'type.required'=>'種別は必須入力です',
                'detail.required'=>'詳細は必須入力です',
                'status.required'=>'販売状態は必須入力です',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'type' => $request->type,
                'detail' => $request->detail,
                'status' => $request->status,
            ]);

            return redirect('/items');
        }

        return view('item.register');
    }

/**
     * 商品編集フォームを表示する
     */
    public function edit(Request $request)
    {
        $item = item::where('id' , '=' , $request->id)->first();

        return view ('item.edit')->with([
            'item' => $item,
        ]);
    }

    /**
     * 商品情報を更新(編集)する
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([  // バリデーション

            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'type' => 'required|integer',
            'detail' => 'required|string|max:500',
            'status' => 'required|integer',

        ],[

            'name.required'=>'商品名は必須入力です',
            'price.required'=>'価格は必須入力です',
            'type.required'=>'種別は必須入力です',
            'detail.required'=>'詳細は必須入力です',
            'status.required'=>'販売状態は必須入力です',

        ]);


        $item = item::where('id' , '=' , $request->id)->first();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->status = $request->status;
        $item->save();

        $validatedData['user_id']=1;
        // $validatedData['user_id']=Auth::id();

        return redirect('/items');
    }

    /**
     * 商品情報を更新(削除)する
     */
    public function destroy(Request $request)
    {
        $item = item::where('id' , '=' , $request->id)->first();
        $item->delete();

        return redirect('/items');
    }

    public function detail($id)
    {
        //データを取得
        $items = Item::all();

        // データが見つからない場合、404ページを表示する
        if (!$items) {
            abort(404, 'データが見つかりません');
        }

        // ビューにデータを渡す
        return view('item.detail', compact('items'));
    }

}
