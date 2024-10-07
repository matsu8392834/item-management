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
    public function index()
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
    
}
