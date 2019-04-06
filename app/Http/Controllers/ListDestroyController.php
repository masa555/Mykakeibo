<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kakeibo;
class ListDestroyController extends Controller
{
   public function Index(Request $request)
   {
       $id= $request->input('id');
       
       $data=kakeibo::find($id);
       
       $data->delete();
       
       return redirect()->to('/list');
   }
}
