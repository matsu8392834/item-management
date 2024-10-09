<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users =User::all();

        $users = User::select('id','name','email','password','role','created_at','updated_at')
        ->sortable()->paginate(5);

        return view('user.index',compact('users'));
    }

    public function edit(Request $request)
    {
        $user =User::find($request->id);
        return view('user.edit',compact('user'));
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
                'name' => 'required',
                'email' => 'required',
        ]);

        $user =User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        $result = $user->save();

        return redirect('/users')->with('updatemessage', '更新しました。');

    }

    public function delete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect('/users')->with('deletemessage', '削除しました。');
            
    }
}
