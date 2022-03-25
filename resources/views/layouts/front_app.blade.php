<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>User Dashboard</title>
        <!-- Favicon -->
       <link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/styles.css">
       <link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/bootstrap.min.css">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
       <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          
      <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
      
    </head>
    <body>  
     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        <div class="backgr_color">
        </div>
        <div class="container backgr_color_cont">
            <header class="row">
                <div class="banner">
                    <img src="<?php echo e(asset('black')); ?>/img/Banner.jpg">
                </div>
            </header>
           
                    @yield('content')
        </div>
        @include('layouts.front_footer')
    </body>
</html>
