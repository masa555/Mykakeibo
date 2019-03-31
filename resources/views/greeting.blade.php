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
         @if($bop['outcome'] == 0 && $bop['can_use'] ==0)
         <p class="text-center" style="margin-top:20%; margin-bottom:20%">今月の収支がまだ登録していません。</p>
         @else
          <canvas id="inoutChart"></canvas>
         @endif
          <h6 class="text-center">今月は残り<span style="color:#c0392b;">{{$bop['can_use']}}</span>円まで使えます。</h6>
     </div>
 <div class="col-sm-4">
     <form class="form-signin" role="form" method="post" action="">
         <div class="form-group">
             <h4>入力シート</h4>
             <input type="hidden" name="_token" value="{{csrf_token()}}">
             <div class="form-inline" style="margin-top:10px">
                 <label for="tag_name">品目:</label>
                 <select style="width:170px" class="form-control form-margin" 
                 id="tag_name"name="title" required autofoucus>
                      <option value="1">食費</option>
                      <option value="2">生活費(日用品)</option>
                      <option value="3">趣味・交際</option>
                      <option value="4">交通費</option>
                      <option value="5">家賃・水光熱・通信</option>
                      <option value="6" selected="selected">その他</option>
                   </select>
             </div>
             <div class="form-inline">
                 <label for="tag_prce">金額:</label>
                 <input type="text" name="price" id="tag_price" 
                 class="form-control form-margin" data-format="$1円"　pattern="^[1-9][0-9]*$" placeholder="金額を入力"required>円
             </div>
              <div class="form-inline">
                 <label for="tag_days">日付:</label>
                 <input type="date" name="purchased_at" id="tag_days" 
                 class="form-control form-margin"　value="@php echo date('Y-m-d'); @endphp"required>
             </div>
             <div class="form-inline">
                 <label for="tag_name">メモ:</label>
                   <input type="text" name="detail" id="tag_detail" 
                   class="form-control form-margin" placeholder="備考">
             </div>
             <div class="form-inline">
          　<label for="tag_name">必要:</label>
          　<input type="checkbox" name="needs" id="tag_needs" value="1" class="form-control form-margin">
            <button class="btn btn-primary" style="margin-left:100px;" type="submit">送信</button>
             </div>
         </div>
     </form>
 </div> 
 <div class="col-sm-4">
     <h5 class="text-center">{{date('n')}}月の出費金額</h5>
      @if($bop['outcome'] == 0)
          <p class="text-center" style="margin-top: 20%;margin-bottom: 20%">今月の支出がまだ登録されてません</p>
          <h6 class="text-center">出費を登録しましょう！</h6>
      @else
          <canvas id="outcomeChart"></canvas>
          <h6 class="text-center">一番多い出費は<span style="color: #c0392b;">{{config('out_title.'.$outcome['max_key'])}}</span>です</h6>
      @endif
   </div> 
   </div>
   <div clas="row">
      <div class="col-sm-4">
         <h4>今月の出費率</h4>
       <h6>出費額の<span style="#c0392b;">{{$need['parsent']}}%</span>は必要ない出費です。</h6>
       <h6>{{$need['need_outcome_count']+$need['not_need_outcome_count']}}件のうち{{$need['not_need_outcome_count']}}件の出費は無駄です</h6>  
      </div>
   <div class="col-sm-8">
       <h4>今週の出費推移グラフ</h4>
    　<canvas id="line_chart" style="width:100%;height: auto;"></canvas>
    </div>
   </div>
   <script>
    @if($bop['outcome'] != 0 || $bop['can_use'] != 0)
    var ctx = document.getElementById('inoutChart').getContext('2d');
    var inoutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['出費', 'つかえるお金'],
            datasets: [{
                backgroundColor: [
                    "#f415d8",
                    "#f48515"
                ],
                data: [{{$bop['outcome']}}, {{$bop['can_use']}}]
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return data.labels[tooltipItem.index]
                            + ": "
                            + data.datasets[0].data[tooltipItem.index]
                            + " 円"; //ここで単位を付けます
                    }
                }
            }
        }
    });
    @endif
    @if($bop['outcome'] != 0)
    var occ = document.getElementById('outcomeChart').getContext('2d');
    var outcomeCart = new Chart(occ,{
        type:'doughnut',
        data:{
            labels:['食費', '生活費', '趣味・交際費', '交通費', '家賃・水光熱費・通信', 'その他'],
            datasets:[{
                backgroundColor:[
                    '#E74C3C',
                    '#3498DB',
                    '#e67e22',
                    '#9b59b6',
                    '#1abc9c',
                    '#95a5a6',
            ],
            data:[{{$outcome[1]}},{{$outcome[2]}},{{$outcome[3]}},{{$outcome[4]}},{{$outcome[5]}},{{$outcome[6]}}]
        }]
       },
       options:{
           tooltips:{
               callbacks:{
                   label:function (tooltipItem,data){
                       return data.labels[tooltipItem.index]
                       +":"
                       +data.datasets[0].data[tooltipItem.index]
                       +"円";
                   }
                 }
                  
               }
             }
    });
    @endif
    var line = document.getElementById("line_chart").getContext('2d');
    var line_chart = new Chart(line, {
        type: 'line',
        data: {
            labels: [
                @foreach($week_outcome as $key => $value)
                "{{$key}}"
                ,
                @endforeach
            ],
            datasets: [{
                label: '出費',
                lineTension:0.1,
                data: [
                    @foreach($week_outcome as $key => $value)
                    {{$value}}
                    ,
                    @endforeach
                ],
                borderColor:[
                    "#22c33f"
                    ],
                pointBorderColor: "#22c33f",
                pointBackgroundColor: "#22c33f",
                pointHoverBackgroundColor: "#22c33f",
                pointHoverBorderColor: "#22c33f",
                pointBorderWidth: 10,
                pointHoverRadius: 10,
                pointHoverBorderWidth: 1,
                pointRadius: 3,
            fill: false,    
                borderWidth:4
            }]
        },
        options: {
             lenged:{
                position: "bottom"
             },
            scales: {
                yAxes: [{
                    ticks: {
                         fontColor: "rgba(0,0,0,0.5)",
                         fontStyle: "bold",
                         beginAtZero: true,
                         maxTicksLimit: 5,
                         padding: 20
                    },
                   gridLines: {
                    drawTicks: false,
                    display: false
                 },
                }],
            xAxes:[{
                gridLines:{
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
             }]
            },
            responsive:true
        }
    });
   </script>
@endsection