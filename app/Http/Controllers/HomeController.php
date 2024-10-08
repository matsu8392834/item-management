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

        return view('home.item-list' , compact('items'));
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
        return view('home.item-detail', compact('items'));
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

}
