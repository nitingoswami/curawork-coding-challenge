@foreach($suggestionData as $data)
<div class="my-2 shadow  text-white bg-dark p-1" id="sugg-{{$data->id}}">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{$data->name}}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{$data->email}}</td>
      <td class="align-middle"> 
    </table>
    <div>
    <a id="create_request_btn_" class="btn btn-primary" onclick="connect({{$data->id}})" href="#a">Connect</a>
    </div>
  </div>
</div>
@endforeach