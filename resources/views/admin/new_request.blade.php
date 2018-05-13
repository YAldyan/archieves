@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambahkan Request</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/store/request') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nm_req') ? ' has-error' : '' }}">
                            <label for="nm_req" class="col-md-4 control-label">Jenis Proyek</label>

                            <div class="col-md-6">
                                <input id="nm_req" type="text" class="form-control" name="nm_req" value="{{ old('nm_req') }}" required autofocus>
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