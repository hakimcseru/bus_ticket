<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Online Bus Ticketing System</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{asset('/css/frontend/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    @yield('owncss')
    <style>
        .adminHoverChange button:hover{
            background-color: white !important;
        }
    </style>

</head>

<body>



<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand biiss-lago" href="{{ url('/') }}"><!--<img src="{{Request::root()}}/images/ticket/logo_web.jpg"">-->Aalbaraka Exclusive Ltd</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a></li>
                <li class="{{ request()->is('new-books') ? 'active' : '' }}"><a href="{{ url('/new-books') }}">New Books</a></li>
                <li class="{{ request()->is('top-books') ? 'active' : '' }}"><a href="{{ url('/top-books') }}">Top Books</a></li>
                <li class="{{ request()->is('top-journals') ? 'active' : '' }}"><a href="{{ url('/top-journals') }}">Top Journals</a></li>
                <li class="{{ request()->is('top-seminars') ? 'active' : '' }}"><a href="{{ url('/top-seminars') }}">Top Seminars</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/print') }}">Wishlist ({{ Cart::instance('default')->count(false) }})</a></li>

                @if (Route::has('login'))

                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="forcolor"> <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span></span></a>
                                <ul class="dropdown-menu">


                                    <li><a href="{{ url('/dashboard') }}" style="border: medium none;background: #fff; padding-left: 28px;">Admin</a></li>

                                    <li><a href="#" class="adminHoverChange">
                                            {{--<i class="material-icons">input</i>--}}

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="float: left;background: #fff;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="" style="border: medium none;background: #fff;">Log Out</button>
                                            </form>

                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                        <li><a href="{{ url('/login') }}"><span class="forcolor"><i class="fa fa-user" aria-hidden="true"></i> Admin Login</span></a></li>
                        @endif

                @endif




            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
use App\Options;
$bannerss= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();


?>

<div class="ticket_header_shadow_area">
        <img src="{{Request::root()}}/images/ticket/shadow.png" style="width:100%">
</div>    
<div class="ticket_header_filter_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ticket_header_filter ticket_header_filter_left">
                        <h4>Online Bus Tickets Booking with Zero Booking Fees</h4>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">From</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="From">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">To</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="To">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputEmail1">Date of Journey</label>
                                    <input type="text" class="form-control" id="start_date" placeholder="Start Date">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputPassword1">Date of Return (Optional)</label>
                                    <input type="text" class="form-control" id="return_date" placeholder="Return Date">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <button type="reset" class="btn btn-danger" style="width:150px">Reset</button>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-danger" style="width:150px">Submit</button>
                                  </div>
                                </div>
                            </div>
                         

                          
                          
                        </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ticket_header_filter">
                      <img src="{{Request::root()}}/images/ticket/bus.png">
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="ticket_middile_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket_middle">
                    <ul class="ticket_middle_list">
                        <li> <i class="fa fa-bus" aria-hidden="true"></i> <span>67000 ROUTES</span></li>
                        <li> <i class="fa fa-users" aria-hidden="true"></i><span>1800 BUS OPERATORS</span></li>
                        <li> <i class="fa fa-ticket" aria-hidden="true"></i><span>6,00,000 + TICKETS SOLD</span></li>
                    </ul>    
                </div>   
            </div>
        </div>
    </div>
</div>  


<div class="ticket_footer_top_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket_footer_top">
                    <ul class="ticket_footer_top_list">
                        <li> <i class="fa fa-car" aria-hidden="true"></i> <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></li>
                        <li> <i class="fa fa-car" aria-hidden="true"></i> <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></li>
                        <li> <i class="fa fa-car" aria-hidden="true"></i> <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></li>
                      
                    </ul>    
                </div>   
            </div>
        </div>
    </div>
</div> 


















<div class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="footer_content_left">
                    <!--<a href="{{ url('/') }}"><img src="{{Request::root()}}/images/biiss.jpg"></a>-->
                    <p style="padding-top: 20px; color: #000;">© <?php echo date('Y')?> Online Bus Tickets Booking System.</p>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Jquery Core Js -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#start_date" ).datepicker();
    $( "#return_date" ).datepicker();
  } );
  </script>


@yield('ownjs')


</body>

</html>