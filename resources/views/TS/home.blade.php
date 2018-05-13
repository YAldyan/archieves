@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Welcome Technical Support</div>

                <div class="panel-body">
                    Hello  {{ Auth::user()->name }} <br />
                    Email Anda  {{ Auth::user()->email }} <br />
                    Anda Login dengan Username : {{ Auth::user()->username }} <br />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
