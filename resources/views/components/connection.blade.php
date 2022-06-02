@foreach($connectionData as $data)
@php
    if(Auth::user()->id == $data->from_id) {$connuser = $data->sentUser;}
    else {$connuser = $data->recivedUser;}
@endphp
<div class="my-2 shadow text-white bg-dark p-1" id="con-{{$data->id}}">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle text-capitalize">
        {{$connuser->name}}
      </td>
      <td class="align-middle"> - </td>
      <td class="align-middle">
        {{$connuser->email}}
      </td>
      
    </table>
    <div>
      <button onclick="common({{$data->id}})" style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
        data-bs-toggle="collapse" data-bs-target="#collapse_{{$data->id}}" aria-expanded="false" aria-controls="collapseExample">
        Connections in common ({{$connuser->commonFriendCount()}})
      </button>
      <a id="create_request_btn_" class="btn btn-danger me-1"  onclick="remove({{$data->id}})" href="#a">Remove Connection</a>
    </div>

  </div>
  <div class="collapse" id="collapse_{{$data->id}}">
    <div id="content_{{$data->id}}" class="p-2">
      {{-- Display data here --}}
      <x-connection_in_common :connuser="$connuser"/>

    </div>
    <div id="connections_in_common_skeletons_">
      {{-- Paste the loading skeletons here via Jquery before the ajax to get the connections in common --}}
    </div>
    <!-- <div class="d-flex justify-content-center w-100 py-2">
      <button class="btn btn-sm btn-primary" id="load_more_connections_in_common_{{$data->id}}">Load
        more</button>
    </div> -->
  </div>
</div>
@endforeach


 
