@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Dokumen</h3>
            <div class="panel panel-default">
                <div class="panel-body">       
                    <table class="table table-striped" id="table">
                        <tr>
                            <th scope="col" width="8%" >
                                ID Arsip
                            </th>
                            <th scope="col" width="15%" >
                                Jenis User
                            </th>
                            <th scope="col" width="15%" >
                                Jenis Arsip
                            </th>
                            <th scope="col" width="42%" >
                                Nama Arsip/Document
                            </th>
                            <th scope="col" width="20%" >
                            </th>
                        </tr>
                        @foreach($document as $doc)
                            @foreach($request as $req)

                                @if ($doc->FK_REQ == $req->ID )
                                <tr class="document{{$doc->ID}}">
                                    <td align='center' >{{$doc->ID}}</td>

                                    @foreach($profile as $prof)
                                        @if ($doc->FK_USER_ID == $prof->ID)
                                            <td>{{$prof->NM_PROFILE}}</td>
                                            <td>{{$req->NM_REQ}}</td>
                                            <td>{{$doc->NM_ARSIP}}</td>
                                            <td>
                                                <button class="edit-document btn btn-info btn-sm" data-id="{{$doc->ID}}" data-nama="{{$doc->NM_ARSIP}}" user-id="{{$prof->ID}}" req-id='{{$req->ID}}'>
                                                    Edit
                                                </button>

                                                <!-- <button class="delete-document btn btn-danger btn-sm" data-id="{{$doc->ID}}">
                                                    Delete
                                                </button> -->
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </table>
                    <!-- Edit modal -->
                    <!-- class="modal-dialog modal-sm" -->
                    <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="panel panel-default">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>

                                        <div class="panel-heading">Ubah Data</div>

                                 <!--    <h4 class="modal-title">Ubah Data</h4> -->
                                    </div>

                                    <div class="panel-body">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    {{ csrf_field() }}
                                                    <input type="text" name="id-document" class="form-control" id="id-document" disabled="true">
                                                </div>
                                                <div class="form-group">
                                                    <select id="fk_req" name="fk_req" class="form-control">
                                                        <option value="Please Select">
                                                            Please Select
                                                        </option>
                                                        @foreach($request as $req)
                                                            <option value="{{$req->ID}}">
                                                                {{$req->NM_REQ}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select id="fk_user_id" name="fk_user_id" class="form-control">
                                                        <option value="Please Select">
                                                            Please Select
                                                        </option>
                                                        @foreach($profile as $prof)
                                                        <option value="{{$prof->ID}}">
                                                            {{$prof->NM_PROFILE}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="nm-doc" id="nm-doc" class="form-control" placeholder="Nama Document">
                                                </div>
                                                <div class="form-group" align="right">
                                                    <button type="button" id="ubahDocument" class="btn btn-primary" data-dismiss="modal">Ubah</button>
                                                </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <!-- Delete modal -->
                    <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Delete Data</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id-document" 
                                        id="id-document">
                                        <p>Yakin Ingin Menghapus Data? </p>
                                    </div>
                                    <div class="form-group" align="right">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="delete-document" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{ $document->render() }}

@endsection