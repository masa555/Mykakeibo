<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\kakeibo;
use App\income;
use Carbon\Carbon;
class SortController extends Controller
{
    public function Index(Request $request)
    {
         #ログイン中のユーザーidを取得
    $user_id = Auth::id();
    #どの場所をソートするか受け取る。
    $genre = $request->input('genre');
    #kakiboテーブル一覧取得
    $data = kakeibo::where('user_id',$user_id)->orderBy($genre, 'desc')->get();
    #並び替え済みのデータを表示するHTMLを取得
    $html_string = view('ajaxlist', ['data' => $data]);
    }
    public function sortIncome(Request $request){
      #ログイン中のユーザーidを取得
      $user_id = Auth::id();
      #どの場所をソートするか受け取る。
      $genre = $request->input('genre');
      #kakiboテーブル一覧取得
      $data =Income::where('user_id',$user_id)->orderBy($genre, 'desc')->get();
      #並び替え済みのデータを表示するHTMLを取得
      $html_string = view('income.list', ['data' => $data]);
      return response($html_string, 200)->header('Content-Type', 'text/html');
  }
}
