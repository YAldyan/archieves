@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Proyek Pengembangan</h3>
            <div class="panel panel-default">
                <div class="panel-body">   
                    <table class="table table-striped" id="table">    
                        <tr>
                            <th scope="col" width="8%" >
                                ID Item
                            </th>
                            <th scope="col" width="15%" >
                                Jenis Request
                            </th>
                            <th scope="col" width="52%" >
                                Nama Item
                            </th>
                            <th scope="col" width="25%" >
                            </th>
                        </tr>
                        @foreach($item as $itm)
                            @foreach($request as $req)

                                @if ($itm->FK_CAT_REQ == $req->ID )

                                    @foreach($useritem as $ust)

                                    @if(Auth::user()->id == $ust->FK_USERS_ID &&
                                       $itm->ID == $ust->FK_ID_ITEM)

                                        @if($profile->ID == $ust->FK_ID_USER)
                                        <tr class="item{{$itm->ID}}">
                                            <td align='center' >{{$itm->ID}}</td>
                                            <td>{{$req->NM_REQ}}</td>
                                            <td>
                                                <a href="/history/item/{{$itm->ID}}"}}> 
                                                    {{$itm->NM_ITEM}}
                                                </a>
                                            </td>
                                            <td>
                                                @if($ust->STATUS == "APPROVED") 
                                                    <h6>Submitted</h6>  
                                                @elseif($itm->STATUS != "COMPLETED")
                                                    <button class="edit-item btn btn-info btn-sm" data-id="{{$itm->ID}}" data-nama="{{$itm->NM_ITEM}}" req-id='{{$req->ID}}'>
                                                        Edit
                                                    </button>

                                                    <button class="delete-item btn btn-danger btn-sm" data-id="{{$itm->ID}}">
                                                        Delete
                                                    </button>
                                                @else 
                                                    <h6>Completed</h6>   
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </table>
                    <!-- <!-- Edit modal -->
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
                                                    <input type="text" name="id-item" class="form-control" id="id-item" disabled="true">
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
                                                    <input type="text" name="nm-item" id="nm-item" class="form-control" placeholder="Nama Item">
                                                </div>
                                                <div class="form-group" align="right">
                                                    <button type="button" id="ubahItem" class="btn btn-primary" data-dismiss="modal">Ubah</button>
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
                                        <input type="hidden" name="id-item" 
                                        id="id-item">
                                        <p>Yakin Ingin Menghapus Data? </p>
                                    </div>
                                    <div class="form-group" align="right">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="delete-item" class="btn btn-danger" data-dismiss="modal">Delete</button>
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

{{ $item->render() }}

@endsection