@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
<!--         <div class="col-md-8 col-md-offset-2"> -->

            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                Daftar Siap UAT
                            </div>

                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        @foreach($useritem as $ust)
                                            @foreach($item as $itm)
                                                @if ($ust->FK_ID_ITEM == $itm->ID
                                                    && $itm->STATUS != "COMPLETED" && $ust->STATUS != 'REJECTED')
                                                    <a href="/QA/history/item/{{$itm->ID}}"}}> 
                                                        {{$itm->NM_ITEM}}
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                Daftar Siap PIR
                            </div>

                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        @foreach($hisotem as $his)
                                            @foreach($pir as $pr)
                                                @if ($his->UPLOAD_STAT == 'NOT'
                                                    && $his->FK_ID_ITEM == $pr->FK_ID_PROJECT)

                                                        @foreach($item as $itm)

                                                            @if($his->FK_ID_ITEM == $itm->ID)
                                                                <a href="/QA/upload/doc/{{$his->FK_ID_ITEM}}"}}> 
                                                                    {{$itm->NM_ITEM}}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
<!--         </div> -->
    </div>
</div>
@endsection
