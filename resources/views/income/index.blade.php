@extends('layouts.app')
@section('title','')
@section('content')

<div class="row">
    <div class="col-md-5">
          {{$message}}
    </div>
    <div class="col-md-offset-3 col-md-2">
        <a href="/"class="btn btn-lg btn-success btn-block" type="button">TOP画面に戻る</a>
    </div>
</div>

<div class="row" style="margin-top: 50px">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-4">
      <form class="form-signin" role="form" method="post" action=""> 
      {{--CSRF対策--}}
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-inline" style="margin-top:  10px">
           @include('errors.error')
          <label style="tag_name">品目:</label>
          <select style="width:200px" class="form-control form-margin" id="tag_name" name="title">
              <option value=1>臨時収入</option>
              <option value=2 selected="selected">会社</option>
              <option value=3>その他</option>
          </select>
      </div>
      <div class="form-inline">
          <label for="tag_price">収入  :</label>
         <input style="width: 200px" type="text" name="price" id="tag_price" class="form-control form-margin" data-format="$1 円"
         pattern="^[1-9][0-9]*$" placeholder="金額を入力" required>  円
      </div>
      <div class="form-inline">
          <label for="tag_days">日付:</label>
        <input style="width: 200px"
        type="date" name="purchased_at" id="tag_days" class="form-control form-margin" value ="@php echo date('Y-m-d'); @endphp" required>  
      </div>
      <div class="row" style="margin-top: 30px" type="date" name="purchased_at" id="tag_days" class="form-control form-margin-right: auto;">
          <button class="btn btn-lg btn-primary" type="submit">送信</button>
      </div>
    </div>
    </form>
    </form>
</div>

<!--収入一覧表-->
<div class="col-sm-12">
    <h4>収入金額一覧表</h4>
    <tr>
   <table class="table table-striped table-bordered table-responsive">
         <th>品目<span onclick="nowalart('title')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>金額<span onclick="nowalart('price')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>日時<span onclick="nowalart('purchased_at')" aria-hidden="true"><i class="fas fa-sort fa-lg"></i>降順</span></th>
         <th>編集</th>
         <th>削除</th>
    </tr>
    <tbody id="response_body">
     @include('income.list')
    </tbody>
   </table>
 </div>
</div>
<!--script-->
<script>
    function nowalart(genre){
        $.ajaxSetup({
            headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"/income/ajax/sort",
            data:{
                "genre":genre
            },
            dataType:'html',
            success:function(data){
                $('#response_body').html(data);
            }
        });
    }
</script>
@endsection