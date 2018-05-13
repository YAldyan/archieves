@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Upload Document Proyek Pengembangan</h3>
            <div class="panel panel-default">
                <div class="panel-body">       
                    <table class="table table-striped" id="table">
                        <tr>
                            <th scope="col" width="4%" >
                                No
                            </th>
                            <th scope="col" width="52%" >
                                Jenis Dokumen
                            </th>
                            <th scope="col" width="44%" >
                                Download File
                            </th>
                        </tr>
                        <!-- <form id="upload-file" class="form-horizontal" role="form" method="post" action="{{ url('/upload/doc') }}"  enctype="multipart/form-data"> -->
                        @foreach($history as $his)
                            <form id="upload-file" class="form-horizontal" role="form" method="post" action="{{ url('/upload/doc') }}"  enctype="multipart/form-data">
                            @foreach($document as $doc)
                                @if ($his->FK_ARSIP_REQ == $doc->ID )
                                <tr class="$doc{{$doc->ID}}">
                                    <td align="center"> {{$doc->ID}} </td>
                                    <td>{{$doc->NM_ARSIP}}</td>
                                    <td>
                                    	<div class="row">
        									<div class="input-field col s6">

          										@if($his->UPLOAD_STAT == "OK")
                                                    <a href="/download/{{$his-> FK_ID_ITEM}}/{{$his->FK_ARSIP_REQ}}"}}>
                                                    {{$doc->NM_ARSIP}}
                                                    </a>
                                                @endif
        									</div>
      									</div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group">
        @if($useritem->STATUS == "OPEN")
            <button id-item='{{$his-> FK_ID_ITEM}}' id="rejected-png" type="button" class="btn btn-info btn-sm">
                Reject
            </button> 
        @endif
        <a href="/QA/upload/doc/{{$his->FK_ID_ITEM}}"}} align="right">
            <button type="button" class="btn btn-info btn-sm">
                Lanjut
            </button>                              
        </a>
    </div>
</div>

{{ $history->render() }}

@endsection