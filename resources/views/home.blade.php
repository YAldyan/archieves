@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <!-- @if(Auth::user()->jabatan == 'Admin')
                    <div class="panel-heading">Welcome Administrator</div>
                @else{
                    <!-- <div class="panel-heading">Welcome Member</div> -->
                    <!-- <script type="text/javascript">
                        window.location = "http://google.com";
                        //here double curly bracket
                    </script>
                @endif -->

                <!-- <div class="panel-heading">Welcome Dashboard</div> -->

                @if(Auth::user()->type == 'QA')
                    <script type="text/javascript">
                        window.location = "/QA/home";
                        //here double curly bracket
                    </script>
                @elseif(Auth::user()->type == 'PNG')
                    <script type="text/javascript">
                        window.location = "/PNG/home";
                        //here double curly bracket
                    </script>
                @elseif(Auth::user()->type == 'OPR')
                    <script type="text/javascript">
                        window.location = "/OPR/home";
                        //here double curly bracket
                    </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
