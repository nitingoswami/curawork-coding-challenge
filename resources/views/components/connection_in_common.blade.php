@foreach($connuser->allConnection() as $data)
    @php
        if($connuser->id == $data->from_id) {$user = $data->sentUser;}
        else {$user = $data->recivedUser;}
    @endphp
    @if($user->isFriend())
        <div class="p-2 shadow rounded mt-2  text-white bg-dark">
            {{$user->name}} - {{$user->email}} 
        </div>
    @endif
@endforeach
