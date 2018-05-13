@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Upload Document</h3>
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
                            <th scope="col" width="34%" >
                                Upload File
                            </th>
                            <th scope="col" width="10%" >
                            </th>
                        </tr>
                        <!-- <form id="upload-file" class="form-horizontal" role="form" method="post" action="{{ url('/upload/doc') }}"  enctype="multipart/form-data"> -->
                        @foreach($history as $his)
                            <form id="upload-file" class="form-horizontal" role="form" method="post" action="{{ url('/QA/store/doc') }}"  enctype="multipart/form-data">
                            @foreach($document as $doc)
                                @if ($his->FK_ARSIP_REQ == $doc->ID && $doc->Mandatory == "YES")
                                <tr class="$doc{{$doc->ID}}">
                                    <td align="center"> {{$doc->ID}} </td>
                                    <td>{{$doc->NM_ARSIP}}</td>
                                    <td>
                                    	<div class="row">
        									<div class="input-field col s6">
        										<input type="hidden" name="_token" value="{{ csrf_token() }}">

        										<input type="hidden" id="fk_arsip_req" name="fk_arsip_req" value="{{$his->FK_ARSIP_REQ}}">

        										<input type="hidden" id="fk_id_item" name="fk_id_item" value="{{$his->FK_ID_ITEM}}">
        										
        										<input type="hidden" id="nm_arsip" name="nm_arsip" value="{{$doc->NM_ARSIP}}">
          										
          										<input type="file" id="inputDOC" name="inputDOC" class="validate">

          										@if($his->UPLOAD_STAT == "OK")
                                                    <a href="/download/{{$his-> FK_ID_ITEM}}/{{$his->FK_ARSIP_REQ}}"}}>
                                                    {{$doc->NM_ARSIP}}
                                                    </a>
                                                @endif
        									</div>
      									</div>
                                    </td>
                                    <td>
                                    @if($useritem->STATUS == 'OPEN')
                                    	<button type="submit" class="btn btn-primary">
                                    		Upload
                                		</button>
                                    @else
                                        <button type="submit" class="btn btn-primary" disabled="true">
                                            Upload
                                        </button>
                                    @endif
                                    </td>
                                @else
                                    @if($his->FK_ARSIP_REQ == $doc->ID && 
                                    $doc->Mandatory == "NO")
                                        @if($pir)
                                            <tr class="$doc{{$doc->ID}}">
                                                <td align="center"> {{$doc->ID}} </td>
                                                <td>{{$doc->NM_ARSIP}}</td>
                                                <td>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                        <input type="hidden" id="fk_arsip_req" name="fk_arsip_req" value="{{$his->FK_ARSIP_REQ}}">

                                                        <input type="hidden" id="fk_id_item" name="fk_id_item" value="{{$his->FK_ID_ITEM}}">
                                                
                                                        <input type="hidden" id="nm_arsip" name="nm_arsip" value="{{$doc->NM_ARSIP}}">
                                                
                                                        <input type="file" id="inputDOC" name="inputDOC" class="validate">

                                                        @if($his->UPLOAD_STAT == "OK")
                                                            <a href="/download/{{$his-> FK_ID_ITEM}}/{{$his->FK_ARSIP_REQ}}"}}>
                                                                {{$doc->NM_ARSIP}}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">
                                                Upload
                                            </button>
                                        </td>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                            </tr>
                        </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($useritem->STATUS == 'OPEN')
        <div class="input-group">
            <textarea id="textarea-input-QA" class="form-control custom-control" rows="5" style="resize:none">
            </textarea>     
            <span id="textarea-button-QA" class="input-group-addon btn btn-primary">Submit</span>
        </div>
    @endif

    @if($userOPR->STATUS == 'APPROVED')
        <div class="input-group">
            <a href="/document/opr/{{$his-> FK_ID_ITEM}}"}} align="right">
                <button type="button" class="btn btn-info btn-sm">
                    Lanjut
                </button>                              
            </a>
        </div>
    @endif

</div>

@endsection