@extends('layouts.app')
@section('title','')
@section('content')
<div class="row">
    <div class="col-md-5">
        {{$message}}
    </div>
    <div class="col-md-offset-1 col-md-2">
        <a href="/list" class="btn btn-lg btn-success btn-block" type="button">自分の家計簿を見てみる</a>
    </div>
    <div class="col-md-2">
        <a href="/income" class="btn btn-lg btn-warning btn-block" type="button">収入を追加する</a>
    </div>
</div>
<div class="row" style="margin-top:50px">
     <div class="col-sm-4">
         <h5 clas="text-center">{{date('n')}}月の合計収支</h5>
         @if($bop['outcome'] === 0 && $bop['can_use'] ===0)
         <p class="text-center" style="margin-top:20%; margin-bottom:20%">今月の収支がまだ登録していません。</p>
         @else
          <canvas id="inoutChart"></canvas>
         @endif
          <h6 class="text-center">今月は残り<span style="color:#c0392b;">{{$bop['can_use']}}</span>円まで使えます。</h6>
     </div>
</div>
    
@endsection