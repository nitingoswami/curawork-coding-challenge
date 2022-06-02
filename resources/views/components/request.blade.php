@foreach($requestsData as $data)

<div class="my-2 shadow text-white bg-dark p-1" id="req-{{$data->id}}">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{$data->sentUser->name}}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{$data->sentUser->email}}</td>
      <td class="align-middle">
    </table>
    <div>
      @if ($mode == 'sent')
        <button id="cancel_request_btn_" class="btn btn-danger me-1"
          onclick="withdraw({{$data->id}})">Withdraw Request</button>
      @else
        <button id="accept_request_btn_" class="btn btn-primary me-1"
          onclick="accept({{$data->id}})">Accept</button>
      @endif
    </div>
  </div>
</div>
@endforeach