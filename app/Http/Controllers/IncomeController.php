<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IncomeRequest;
use Illuminate\Support\Facades\Auth;
use App\income;
use Carbon\Carbon;
class IncomeController extends Controller
{
   public function index()
   {
       $user_id=Auth::id();
       
       $data=income::where('user_id',$user_id)->get();
       
       return view('income.index',['data'=>$data,'message'=>'収入管理をしましょう']);
   }
   public function create(IncomeRequest $request)
   {
      $income=  new Income;
      $income->user_id =Auth::id();
      $income->title=$request->input('title');
      $income->price=$request->input('price');
      $income->purchased_at = $request->input('purchased_at');
      $income->save();
      $data=Income::where('user_id',Auth::id())->get();
      
      return view('income.index',['data'=>$data,'message'=>'記入ありがとうございました。']);
      
   }
   public function edit(Request $request)
   {
      $id= $request->input('id');
      
      $data=Income::find($id);
      
      return view('income.edit',['data'=>$data,'message'=>'ここで編集することができます。']);
   }
   public function  update(IncomeRequest $request)
   {
      $id=$request->input('id');
      $income=Income::find($id);
      //postされた更新データを受け取る
      $income->title=$request->title;
      $income->price=$request->price;
      $income->purchased_at=$request->purchased_at;
      //更新する 
      $income->save();
      $data=Income::where('user_id',Auth::id())->get();
      return redirect()->to('/income');
   }
   public function  destroy(Request $request)
   {
      $id =$request->input('id');
      $data=Income::find($id);
      $data->delete();
      return redirect()->to('/income');
   }
}
