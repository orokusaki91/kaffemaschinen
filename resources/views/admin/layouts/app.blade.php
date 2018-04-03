<!DOCTYPE html>
<html lang="en">
<head>
    <!-- FA FA ICONS -->
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Centrocaffe E-commerce</title>


    <link href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/styles.css?ver=' . str_random(10)) }}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    @stack('styles')
</head>
<body>

@include("admin.layouts.nav")

<div class="container-fluid" style="padding: 0;">
    <div class="row" style="width: 100%;">
        <div class="col-lg-2">
            <aside class="" style="">
                @include("admin.layouts.left-nav")
            </aside>
        </div>

        <div class="col-lg-10">
            <div class="main-content" style="padding-top: 1rem;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-0 text-center">
                @if(session()->has('notificationText'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                        <strong>Success!</strong> {{ session()->get('notificationText') }}

                    </div>
                @endif
            </div>
        </div>
        @yield('content')
    </div>

    @include('admin.layouts.footer')
</div>
        </div>
    </div>
</div>







<script src="{{ asset('back/js/jquery-3.2.1.min.js') }}"></script>

<script src="https://cdn.datatables.net/v/bs/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

<script src="{{ asset('back/js/popper.min.js') }}"></script>
<script src="{{ asset('back/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('back/js/bootstrap-notify.min.js') }}"></script>

<script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('back/js/select2.full.min.js') }}"></script>

@stack('scripts')

</body>
</html>
