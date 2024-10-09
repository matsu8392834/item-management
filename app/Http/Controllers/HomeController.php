<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index(Request $request)
     {
         return view('home.home-list');
     }

    public function index2()
    {
        $items = Item::all();

        $items = Item::select('id','user_id','name','price','type','detail','status','created_at','updated_at')
        ->paginate(5);

        return view('home.item-list' , compact('item'));
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
        return view('home.item-detail', compact('item'));
    }
    

    // 画像アップロード
    public function create()
    {
        return view('home.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('home'), $imageName);

        Image::create(['filename' => $imageName]);

        //POSTされた画像ファイルデータ取得しbase64でエンコードする
        $image = base64_encode(file_get_contents($request->image->getRealPath()));
        // base64エンコードしたバイナリデータを格納
        Model::insert([
        "comment" => $comment,
        "image" => $image
            ]); 

        return redirect("/image")->with('success', '画像がアップロードされました。');

        // return redirect()->route('images.show')->with('success', '画像がアップロードされました。');
    }


    public function show($id)
    {
        $image = Image::all();
        return view('home.show', compact('image'));
    }

    public function search(Request $request)
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

        return view('home/item-list', compact('items', 'keyword'));

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