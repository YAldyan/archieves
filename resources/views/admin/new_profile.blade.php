@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buat User Profile Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/store/profile') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('cd_profile') ? ' has-error' : '' }}">
                            <label for="cd_profile" class="col-md-4 control-label">Kode Profile</label>

                            <div class="col-md-6">
                                <input id="cd_profile" type="text" class="form-control" name="cd_profile" value="{{ old('cd_profile') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nm_profile') ? ' has-error' : '' }}">
                            <label for="nm_profile" class="col-md-4 control-label">Nama Profile</label>

                            <div class="col-md-6">
                                <input id="nm_profile" type="text" class="form-control" name="nm_profile" value="{{ old('nm_profile') }}" required autofocus>
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