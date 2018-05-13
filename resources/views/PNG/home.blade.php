@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Daftar Project Untuk Follow Up</div>

                <div class="panel-body">
                    <ul class="list-group">
                            @foreach($useritem as $ust)
                                @foreach($item as $itm)
                                    @if ($ust->FK_ID_ITEM == $itm->ID 
                                        && $itm->STATUS != "COMPLETED"
                                        && $ust->STATUS == "OPEN")
                                            @if(Auth::user()->id == $ust->FK_USERS_ID)
                                                <li class="list-group-item">
                                                    <a href="/history/item/{{$itm->ID}}"}}> 
                                                        {{$itm->NM_ITEM}}
                                                    </a>
                                                </li>
                                            @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
