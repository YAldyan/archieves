<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="icon" href="/image/favicon.ico" type="image/x-icon">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/toastr.css" rel="stylesheet">

    <script src="/js/jquery.min.js"></script>
    <!-- <script src="/js/bootstrap.min.js"></script> -->
    <script src="/js/toastr.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        function setbg(color){
            document.getElementById("styled").style.background=color ;
        }
        
        function handleTextarea(textarea){
            opinion = textarea.value ;
        }

        function profile(){

            // alert('Masuk Profile !!');

            // alert('Address URL : '+window.location.pathname);

            if(window.location.pathname == '/register'){

                $.ajax({
                    type: 'get',
                    url: '/get/profile',
                    data:'_token = <?php echo csrf_token() ?>',
                    dataType: 'json',
            
                    success: function(data) {

                        console.log(data);

                        $data = '<select id="profile-register" name="profile-register" class="form-control" >'

                        $.each(data, function(idx, obj) {
                            $data += '<option value="'+obj.CD_PROFILE+'">'+obj.NM_PROFILE+'</option>' ;
                        });

                        $data += '</select>' ; 

                        $("select#profile-register").replaceWith($data);        
                    },   
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Profile Gagal Dibaca.");
                    },
                });

            }
            
        }
    </script>

    <script type="text/javascript">

            $(document).on('click', '#edit-user', function(e) {

                var $name = $('#name').val();
                var $username = $('#username').val();
                var $email = $('#email').val();

                // alert('Nama : '+$name+" Username : "+$username+" Email : "+$email);

                var formData = {
                        name: $name,
                        username: $username,
                        email: $email,
                }

                $.ajax({
                    type: 'GET',
                    url: '/edit/user/profile',
                    data: formData,
                    dataType: 'json',
                        
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Sukses Perbaharui Data User");

                                setTimeout("location.reload(true);", 1000);
                                // window.location.replace("/QA/modify/flow");
                            }
                            else{
                                toastr.success("Sukses Perbaharui Data User");
                            }

                        },
                        error: function (data) {
                            toastr.success("Item Gagal Submit");
                        }
                });
            });

            $(document).on('click', '#submit-last', function(e) {

                var $id_item = $(this).attr('id-item-submit');

                alert('ID ITEM : '+$id_item) ;

                var formData = {
                        id_item: $id_item,
                }

                $.ajax({
                    type: 'GET',
                    url: '/completed/item/',
                    data: formData,
                    dataType: 'json',
                        
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Item Submit Sukses");

                                setTimeout("location.reload(true);", 1000);
                                // window.location.replace("/QA/modify/flow");
                            }
                            else{
                                toastr.success("Item Gagal Submit");
                            }

                        },
                        error: function (data) {
                            toastr.success("Item Gagal Submit");
                        }
                });
            });

            $(document).on('click', '#flow-profile', function(e) {

                var $id_prof = $('#prof_id').val() ;
                var $nm_prof = $('#nm_prof').val() ;

                alert('ID PROFILE : '+$id_prof+" Nama Profile : "+$nm_prof);

                var formData = {
                        id_prof: $id_prof,
                        nm_prof: $nm_prof,
                }

                $.ajax({
                    type: 'GET',
                    url: '/modify/flow/',
                    data: formData,
                    dataType: 'json',
                        
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Setting Flow Berhasil");

                                // setTimeout("location.reload(true);", 1000);
                                window.location.replace("/QA/modify/flow");
                            }
                            else{
                                toastr.success("Setting Flow Gagal");
                            }

                        },
                        error: function (data) {
                            toastr.success("Setting Flow Gagal");
                        }
                });
            });

            $(document).on('click', '#rejected-opr', function(e) {

                alert('ID Item : '+$(this).attr('id-item'));

                var $id_item = $(this).attr('id-item') ;

                var formData = {
                        id_item: $id_item,
                }

                $.ajax({
                    type: 'GET',
                    url: '/reject/opr/'+$id_item,
                    data: formData,
                    dataType: 'json',
                        
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Document Was Rejected");

                                // setTimeout("location.reload(true);", 1000);
                                window.location.replace("/QA/home");
                            }
                            else{
                                toastr.success("Please Complete your document, all the documents is mandatory");
                            }

                            // setTimeout("location.reload(true);", 1000);

                        },
                        error: function (data) {
                            alert('Error: ', data);
                            toastr.success("Data Gagal Diubah.");
                        }
                });
            });

         $(document).on('click', '#rejected-png', function(e) {

                alert('ID Item : '+$(this).attr('id-item'));

                var $id_item = $(this).attr('id-item') ;

                var formData = {
                        id_item: $id_item ,
                }

                $.ajax({
                    type: 'GET',
                    url: '/reject/png/'+$id_item,
                    data: formData,
                    dataType: 'json',
                        
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Document Was Rejected");

                                // setTimeout("location.reload(true);", 1000);
                                window.location.replace("/QA/home");
                            }
                            else{
                                toastr.success("Please Complete your document, all the documents is mandatory");
                            }

                            // setTimeout("location.reload(true);", 1000);

                        },
                        error: function (data) {
                            alert('Error: ', data);
                            toastr.success("Data Gagal Diubah.");
                        }
                });
        });

        $(document).on('click', '#textarea-button-OPR', function(e) {

            var txt = $('#textarea-input-opr').val();
            var id_item = $('#fk_id_item').val();

            // alert("ID Item : "+id_item);

            var formData = {
                        id_item: $('#fk_id_item').val(),
                        msg:$('#textarea-input-opr').val(),
                }

            if(!txt.trim()){
                alert('Please Fill Comment Area, give your Comment !!');
            }
            else{
                //alert('Jalankan Ajax Request');

                $.ajax({
                    type: 'GET',
                    url: '/submit/opr/' + id_item,
                    data: formData,
                    dataType: 'json',
                        
            
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Berhasil Submit Project");

                                setTimeout("location.reload(true);", 1000);
                            }
                            else{
                                toastr.success("Please Complete your document, all the documents is mandatory");
                            }

                            // setTimeout("location.reload(true);", 1000);

                        },
                        error: function (data) {
                            alert('Error: ', data);
                            toastr.success("Data Gagal Diubah.");
                        }
                });
            }
        }); 


        $(document).on('click', '#textarea-button-QA', function(e) {

            var txt = $('#textarea-input-QA').val();
            var id_item = $('#fk_id_item').val();

            // alert("ID Item : "+id_item);

            var formData = {
                        id_item: $('#fk_id_item').val(),
                        msg: $('#textarea-input-QA').val(),
                }

            if(!txt.trim()){
                alert('Please Fill Comment Area, give your Comment !!');
            }
            else{
                //alert('Jalankan Ajax Request');

                $.ajax({
                    type: 'GET',
                    url: '/submit/QA/' + id_item,
                    data: formData,
                    dataType: 'json',
                        
            
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Berhasil Submit Project");

                                setTimeout("location.reload(true);", 1000);
                            }
                            else{
                                toastr.success("Please Complete your document, all the documents is mandatory");
                            }

                            // setTimeout("location.reload(true);", 1000);

                        },
                        error: function (data) {
                            alert('Error: ', data);
                            toastr.success("Data Gagal Diubah.");
                        }
                });
            }
        }); 

        $(document).on('click', '#textarea-button', function(e) {

            var txt = $('#textarea-input-png').val();
            var id_item = $('#fk_id_item').val();

            // alert("ID Item : "+id_item);

            var formData = {
                        id_item: $('#fk_id_item').val(),
                        msg: $('#textarea-input-png').val(),
                }

            if(!txt.trim()){
                alert('Please Fill Comment Area, give your Comment !!');
            }
            else{
                //alert('Jalankan Ajax Request');

                $.ajax({
                    type: 'GET',
                    url: '/submit/png/' + id_item,
                    data: formData,
                    dataType: 'json',
                        
            
                        success: function(data) {                        

                            console.log(data);

                            if(data.trim() == 'OK'){
                                toastr.success("Berhasil Submit Project");

                                setTimeout("location.reload(true);", 1000);
                            }
                            else{
                                toastr.success("Please Complete your document, all the documents is mandatory");
                            }

                            // setTimeout("location.reload(true);", 1000);

                        },
                        error: function (data) {
                            alert('Error: ', data);
                            toastr.success("Data Gagal Diubah.");
                        }
                });
            }
        });   

        // 1. Menu Untuk Edit Profile Type
        $(document).on('click', '.edit-item', function() {

            $('#id-item').val($(this).attr('data-id'));
            $('#fk_req').val($(this).attr('req-id'));
            $('#nm-item').val($(this).attr('data-nama'));
            $('.bs-example-modal-sm2').modal('show');
        });

        // 2. Menu Untuk Konfirmasi Perubahan Nilai/Value Profile Type
        $(document).ready(function() {
    
            $("#ubahItem").click(function() {

                var $id_item = $('#id-item').val() ;
                var $nm_item = $('#nm-item').val() ;
                var $fk_req = $('#fk_req').val() ;


                var $myUrl = "/edit/item/"+ $id_item ;

                var formData = {
                        id_item: $('#id-item').val(),
                        fk_req: $('#fk_req').val(),
                        nm_item: $('#nm-item').val(),
                    }

                // alert('Kode Item : '+$id_item+' Nama Item : '+$nm_item+' URL : '+$myUrl); 

                $.ajax({
                    type: 'GET',
                    url: '/edit/item/' + $id_item,
                    data: formData,
                    dataType: 'json',
            
                    success: function(data) {                        

                        console.log(data);

                        toastr.success("Data Berhasil Diubah.");

                        setTimeout("location.reload(true);", 1000);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Diubah.");
                    }
                });
            });
        });

        // 3. Menu Untuk Delete Profile Type
        $(document).on('click', '.delete-item', function() {
            $('#id-item').val($(this).attr('data-id'));
            $('.bs-example-modal-sm3').modal('show');
        });

        // 4. Menu Untuk Konfirmasi Delete Arsip
        $(document).ready(function() {

            $("#delete-item").click(function() {

                var $id_item = $('#id-item').val() ;

                var $myUrl = "/delete/item/"+ $id_item ;

                // alert("Kode Arsip : "+$kd_arsip+" Kode Data Asli : "+$kode_data_asli);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    data: { "_token": "{{ csrf_token() }}" },
                    url: "/delete/item/"+ $id_item,

                    success: function(data) {
                        $('tr.item' + $id_item).remove();
                        
                        toastr.success("Data Berhasil Dihapus.");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Dihapus.");
                    }
                });
            });
        });

        /*
            JQuery, Javascript untuk menu divisi
        */

        // 1. Menu Untuk Edit Profile Type
        $(document).on('click', '.edit-profile', function() {

            $('#id-profile').val($(this).attr('data-id'));
            $('#cd-profile').val($(this).attr('data-kode'));
            $('#nm-profile').val($(this).attr('data-nama'));
            $('.bs-example-modal-sm2').modal('show');
        });

        // 2. Menu Untuk Konfirmasi Perubahan Nilai/Value Profile Type
        $(document).ready(function() {
    
            $("#ubahProfile").click(function() {

                var $id_profile = $('#id-profile').val() ;
                var $nm_profile = $('#nm-profile').val() ;
                var $cd_profile = $('#cd-profile').val() ;


                var $myUrl = "/edit/profile/"+ $id_profile ;

                var formData = {
                        id_profile: $('#id-profile').val(),
                        cd_profile: $('#cd-profile').val(),
                        nm_profile: $('#nm-profile').val(),
                    }

                // alert('Kode Profile : '+$id_profile+' Nama Profile : '+$nm_profile+' URL : '+$myUrl); 

                $.ajax({
                    type: 'GET',
                    url: '/edit/profile/' + $id_profile,
                    data: formData,
                    dataType: 'json',
            
                    success: function(data) {                        

                        console.log(data);

                        var profile = '<tr class="profile' + $id_profile + '"><td>'+ $id_profile +'</td><td>' + $cd_profile + '</td><td>' + $nm_profile + '</td>';

                        profile += '<td><button class="edit-profile btn btn-info btn-sm" data-id="' + $id_profile + '"data-nama="'+ $nm_profile + '" data-kode="'+$cd_profile+'">Edit </button> ';

                        profile += '<button class="delete-profile btn btn-danger btn-sm" data-id="' + $id_profile +'">Delete</button></td></tr>';

                        $("tr.profile" + $id_profile).replaceWith(profile);

                        toastr.success("Data Berhasil Diubah.");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Diubah.");
                    }
                });
            });
        });

        // 3. Menu Untuk Delete Profile Type
        $(document).on('click', '.delete-profile', function() {
            $('#id-profile').val($(this).attr('data-id'));
            $('.bs-example-modal-sm3').modal('show');
        });

        // 4. Menu Untuk Konfirmasi Delete Arsip
        $(document).ready(function() {

            $("#delete-profile").click(function() {

                var $id_profile = $('#id-profile').val() ;

                var $myUrl = "/delete/profile/"+ $id_profile ;

                // alert("Kode Arsip : "+$kd_arsip+" Kode Data Asli : "+$kode_data_asli);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    data: { "_token": "{{ csrf_token() }}" },
                    url: '/delete/profile/' + $id_profile,

                    success: function(data) {
                        $('tr.profile' + $id_profile).remove();
                        
                        toastr.success("Data Berhasil Dihapus.");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Dihapus.");
                    }
                });
            });
        });



        // 1. Menu Untuk Edit Jenis Request
        $(document).on('click', '.edit-request', function() {

            // alert('Masuk Edit Request');

            $('#id-request').val($(this).attr('data-id'));
            $('#nm-req').val($(this).attr('data-nama'));
            $('.bs-example-modal-sm2').modal('show');
        });

        // 2. Menu Untuk Konfirmasi Perubahan Nilai/Value Request Type
        $(document).ready(function() {
    
            $("#ubahRequest").click(function() {

                var $id_request = $('#id-request').val() ;
                var $nm_req = $('#nm-req').val() ;

                var formData = {
                        id_request: $('#id-request').val(),
                        nm_req: $('#nm-req').val(),
                    }

                // alert('Kode Profile : '+$id_profile+' Nama Profile : '+$nm_profile+' URL : '+$myUrl); 

                $.ajax({
                    type: 'GET',
                    url: '/edit/request/' + $id_request,
                    data: formData,
                    dataType: 'json',
            
                    success: function(data) {                        

                        console.log(data);

                        var request = '<tr class="request' + $id_request + '"><td>'+ 
                        $id_request +'</td><td>' + $nm_req + '</td>';

                        request += '<td><button class="edit-request btn btn-info btn-sm" data-id="' + $id_request + '"data-nama="'+ $nm_req + '" data-kode="'+$id_request+'">Edit </button> ';

                        request += '<button class="delete-request btn btn-danger btn-sm" data-id="' + $id_request +'">Delete</button></td></tr>';

                        $("tr.request" + $id_request).replaceWith(request);

                        toastr.success("Data Berhasil Diubah.");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Diubah.");
                    }
                });
            });
        });

        // 3. Menu Untuk Delete Profile Type
        $(document).on('click', '.delete-request', function() {
            $('#id-request').val($(this).attr('data-id'));
            $('.bs-example-modal-sm3').modal('show');
        });

        // 4. Menu Untuk Konfirmasi Delete Arsip
        $(document).ready(function() {

            $("#delete-request").click(function() {

                var $id_request = $('#id-request').val() ;

                var $myUrl = "/delete/request/"+ $id_request ;

                // alert("Kode Arsip : "+$kd_arsip+" Kode Data Asli : "+$kode_data_asli);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    data: { "_token": "{{ csrf_token() }}" },
                    url: '/delete/request/' + $id_request,

                    success: function(data) {
                        $('tr.request' + $id_request).remove();
                        
                        toastr.success("Data Berhasil Dihapus.");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Dihapus.");
                    }
                });
            });
        });



        // 1. Menu Untuk Edit Jenis Document
        $(document).on('click', '.edit-document', function() {

            var request = document.getElementById('fk_req');
            request.value = $(this).attr('req-id');

            var userid = document.getElementById('fk_user_id');
            userid.value = $(this).attr('user-id');

            $('#id-document').val($(this).attr('data-id'));
            $('#nm-doc').val($(this).attr('data-nama'));
            $('.bs-example-modal-sm2').modal('show');
        });


        // 2. Menu Untuk Konfirmasi Perubahan Nilai/Value Document Type
        $(document).ready(function() {
    
            $("#ubahDocument").click(function() {

                var $fk_req = $('#fk_req').val() ;
                var $fk_user_id = $('#fk_user_id').val() ;
                var $nm_doc = $('#nm-doc').val() ;
                var $id_doc = $('#id-document').val() ;

                var formData = {
                        nm_doc: $('#nm-doc').val(),
                        fk_req: $('#fk_req').val(),
                        fk_user_id: $('#fk_user_id').val(),
                } 

                $.ajax({
                    type: 'GET',
                    url: '/edit/document/' + $id_doc,
                    data: formData,
                    dataType: 'json',
            
                    success: function(data) {                        

                        console.log(data);

                        toastr.success("Data Berhasil Diubah.");

                        setTimeout("location.reload(true);", 1000);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Diubah.");
                    }
                });
            });
        });

        // 3. Menu Untuk Delete Profile Type
        $(document).on('click', '.delete-document', function() {
            $('#id-document').val($(this).attr('data-id'));
            $('.bs-example-modal-sm3').modal('show');
        });

        // 4. Menu Untuk Konfirmasi Delete Arsip
        $(document).ready(function() {

            $("#delete-document").click(function() {

                var $id_document = $('#id-document').val() ;

                var $myUrl = "/delete/document/"+ $id_document ;

                // alert("Kode Arsip : "+$kd_arsip+" Kode Data Asli : "+$kode_data_asli);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    data: { "_token": "{{ csrf_token() }}" },
                    url: "/delete/document/"+ $id_document,

                    success: function(data) {
                        $('tr.document' + $id_document).remove();
                        
                        toastr.success("Data Berhasil Dihapus.");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.success("Data Gagal Dihapus.");
                    }
                });
            });
        });

    </script>
</head>
<body onload="profile()">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <img src="/image/logo-kecil.png">
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            @if(Auth::user()->type == 'QA')
                            <li><a href="{{ url('/QA/home') }}">Home</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" 
                                    href="#">
                                    Profile <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/show/profile') }}">Show</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/add/profile') }}">Add</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/QA/modify/flow') }}">Flow</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" 
                                    href="#">
                                        Request <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                    <a href="{{ url('/show/request') }}">Show</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/add/request') }}">Add</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" 
                                    href="#">
                                        Document <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/show/document') }}">Show</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/add/document') }}">Add</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" 
                                    href="#">
                                        Project <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/QA/project/item') }}">
                                            Show
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @elseif(Auth::user()->type == 'PNG')
                            <li><a href="{{ url('/PNG/home') }}">Home</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" 
                                    href="#">
                                    Project <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/show/item') }}">Show</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/add/item') }}">Add</a>
                                    </li>
                                </ul>
                            </li>
                            @elseif(Auth::user()->type == 'OPR')
                            <li><a href="{{ url('/OPR/home') }}">Home</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        @if(Auth::user()->type == 'PNG')
                                            <a href="{{ url('/png/user/edit') }}">
                                                User
                                            </a>
                                        @elseif(Auth::user()->type == 'QA')
                                            <a href="{{ url('/QA/user/edit') }}">
                                                User
                                            </a>
                                        @elseif(Auth::user()->type == 'OPR')
                                            <a href="{{ url('/opr/user/edit') }}">
                                                User
                                            </a>
                                        @endif     

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
