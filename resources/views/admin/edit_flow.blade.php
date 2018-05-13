@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Jenis Dokumen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fk_req') ? ' has-error' : '' }}">
                            <label for="fk_req" class="col-md-4 control-label">Tipe User</label>

                            <div class="col-md-6">
                                <select id="prof_id" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    @foreach($profile as $prof)
                                        <option value="{{$prof->ID}}">
                                            {{$prof->NM_PROFILE}}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('prof_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prof_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fk_user_id') ? ' has-error' : '' }}">
                            <label for="fk_user_id" class="col-md-4 control-label">Assign To</label>

                            <div class="col-md-6">
                                <select id="nm_prof" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    @foreach($profile as $prof)
                                        <option value="{{$prof->CD_PROFILE}}">
                                            {{$prof->NM_PROFILE}}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('nm_prof'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nm_prof') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="flow-profile">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
