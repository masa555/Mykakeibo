<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kakeibo;
use App\income;
use App\Http\Requests\ListRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ListController extends Controller
{
    public function Index(Request $request)
    {
        $user_id=Auth::id();
        $data=kakeibo::where('user_id',$user_id)->get();
       
        return view ('list',['data'=>$data,'message'=>'ここが出費の一覧です。']);
    }
     public function edit(Request $request)
   {
      $id= $request->input('id');
      
      $data=kakeibo::find($id);
      
      return view('edit',['data'=>$data,'message'=>'出費の編集']);
   }
   public function  update(ListRequest $request)
   {
      $id=$request->input('id');
      $data=kakeibo::find($id);
      //postされた更新データを受け取る
      $data->title=$request->title;
      $data->price=$request->price;
      $data->detail=$request->detail;
       if($request->needs == NULL){
            $data->needs = 0;
        }elseif ($request->needs == 1){
            $data->needs = 1;
        }
      //更新する 
      $data->save();
      return redirect()->to('/list');
   }
}
