@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Project</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/store/item') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fk_req') ? ' has-error' : '' }}">
                            <label for="fk_req" class="col-md-4 control-label">Jenis Request</label>

                            <div class="col-md-6">
                                <select name="fk_req" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    @foreach($request as $req)
                                        <option value="{{$req->ID}}">
                                            {{$req->NM_REQ}}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('fk_req'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fk_req') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nm_item') ? ' has-error' : '' }}">
                            <label for="nm_item" class="col-md-4 control-label">Nama Project</label>

                            <div class="col-md-6">
                                <input id="nm_item" type="text" class="form-control" name="nm_item" value="{{ old('nm_item') }}" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
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
