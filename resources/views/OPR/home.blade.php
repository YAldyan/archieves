@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Daftar Project Release</div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            @foreach($useritem as $ust)
                                @foreach($item as $itm)
                                    @if ($ust->FK_ID_ITEM == $itm->ID 
                                        && $itm->STATUS != "COMPLETED"
                                        && $ust->STATUS == "OPEN")
                                        <a href="/OPR/history/item/{{$itm->ID}}"}}> 
                                            {{$itm->NM_ITEM}}
                                        </a>
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
