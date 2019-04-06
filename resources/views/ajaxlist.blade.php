@foreach($data as $row)
 <tr>
     @if ($row->title == 1)
         <td>食費</td>
     @elseif ($row->title == 2)
         <td>生活費(日用品)</td>
     @elseif ($row->title == 3)
         <td>趣味・交際</td>
     @elseif ($row->title == 4)
         <td>交通費</td>
     @elseif ($row->title == 5)
         <td>家賃・水光熱・通信</td>
     @else
         <td>その他</td>
     @endif
 <td>{{ $row->price }}円</td>
 <td>{{ $row->purchased_at }}</td>
 <td>{{ $row->detail }}</td>
    @if($row->needs == 1)
        <td>YES</td>
    @elseif($row->needs == 0)
        <td>NO</td>
    @endif
 <td>{{ $row->updated_at }}</td>
 <td>
         @include('errors.error')
   <form method="post" action="/list/edit">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <input type="hidden" name="id" value="{{ $row->id }}">
     <input type="submit" value="編集" class="btn btn-primary btn-sm">
   </form>
 </td>
 <td>
    <form method="post" action="/list/destroy">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="id" value="{{ $row->id }}">
      <input type="submit" value="削除" class="btn btn-danger btn-sm btn-destroy">
    </form>
 </td>
 </tr>
@endforeach