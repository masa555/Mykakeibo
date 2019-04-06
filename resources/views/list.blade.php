@extends('layouts.app')
@section('title', 'レシート一覧')
@section('content')
<div class="row">
    <div class="col-md-5">
        {{$message}}
    </div>
    <div class="col-md-offset-5 col-md-2">
         <a href="/" class="btn btn-lg btn-primary btn-block" type="button" style="margin-bottom:20px">記入に戻る</a>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<table class="table table-striped table-bordered">
    <tr>
         <th>品目<span onclick="nowalart('title')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>金額<span onclick="nowalart('price')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>日時<span onclick="nowalart('purchased_at')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>詳細<span onclick="nowalart('detail')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th></th>
         <th>必要<span onclick="nowalart('needs')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th></th>
         <th>更新日</th>
         <th>編集</th>
         <th>削除</th>
    </tr>
    <tbody id="response_body">
        @include('ajaxlist')
    </tbody>
</table>
<script>
function nowalart(genre) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
     type: "GET",
     url: "/sort/",
     data: {
       "genre": genre
     },
     dataType: 'html',
     success: function(data){
       $('#response_body').html(data);
     }
   });
}
</script>
@endsection