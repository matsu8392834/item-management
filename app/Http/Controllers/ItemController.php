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

        $items = Item::select('id','user_id','name','price','type','detail','status','created_at','updated_at')
        ->sortable()->paginate(5);

      

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

            session()->flash('message', '登録が完了しました。');

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

        return redirect('/items')->with('updatemessage', '更新しました。');
    }

    /**
     * 商品情報を更新(削除)する
     */
    public function destroy(Request $request)
    {
        $item = item::where('id' , '=' , $request->id)->first();
        $item->delete();

        return redirect('/items')->with('deletemessage', '削除しました。');
    }

    public function detail($id)
    {
        //データを取得
        $item = Item::find($id);

        // データが見つからない場合、404ページを表示する
        if (!$item) {
            abort(404, 'データが見つかりません');
        }

        // ビューにデータを渡す
        return view('item.detail', compact('item'));
    }

    public function find(Request $request)
    {
        $keyword = trim($request->keyword);
        $query = Item::query();

        // 部分一致によるタイプの検索
        $typeValue = $this->convertKeywordToType($keyword);
        $statusValue = $this ->convertStatusToString($keyword);


        if (!empty($keyword) && empty($typeValue)) { 
                $query->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('detail', 'LIKE', "%$keyword%");
        }

        if (!empty($typeValue)) {
            $query->where("type", $typeValue);
        }

        // 価格の範囲検索
        if ($request->filled('price_min') || $request->filled('price_max')) {
            $query->whereBetween('price', [
                $request->input('price_min', 0),
                $request->input('price_max', PHP_INT_MAX)
            ]);
        }

        // クエリの実行
        $items = $query->paginate(2);
        //dump($items);

        return view('item.list', compact('items', 'keyword'));

    }

     // キーワードをタイプに変換するメソッド
    private function convertKeywordToType($keyword)
     {

         $typeMapping = [
             'スポーツ用品' => 1,
             '食料品' => 2,
             '日用品' => 3,
             '家電製品' => 4,
             'エンタメグッズ' => 5,
             'ファッション' => 6,
             'インテリア用品' => 7,
             'その他' => 8
         ];
 
         // 部分一致でキーワードを検索
        if (array_key_exists($keyword, $typeMapping)) {
            return $typeMapping[$keyword];
        }

         return null;
     }

     // ステータスの数値を文字列に変換するメソッド
     private function convertStatusToString($status)
     {
         $statusMapping = [
             1 => '在庫あり',
             2 => '在庫なし',
             3 => '予約受付中',
         ];
 
         return $statusMapping[$status] ?? '不明';
     }

}