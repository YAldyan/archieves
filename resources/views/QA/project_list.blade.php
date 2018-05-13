@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Project Accomplished</h3>
            <div class="panel panel-default">
                <div class="panel-body">    
                    @foreach($item as $itm)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/QA/history/item/{{$itm->ID}}">
                                {{$itm->NM_ITEM}}
                            </a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection