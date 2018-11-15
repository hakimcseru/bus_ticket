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
    <!-- jQuery news Ticker-->
    <!-- <link href="{{asset('/plugins/jQuery-News-Ticker-master/styles/ticker-style.css')}}" rel="stylesheet"> -->

    <!-- Custom Css -->
    <link href="{{asset('/css/frontend/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 @yield('owncss')
    <style>
        .adminHoverChange button:hover{
            background-color: white !important;
        }
        .trigger {
            display: none;
        }
        .checker {
            /*background-image: url({{asset('images/icon/demo.png')}});*/
            background-position: left center;
            background-size: auto 100%;
            width: 60px;
            height: 40px;
            background-repeat: no-repeat;
            border:1px solid #ccc;
        }
        .trigger:checked + .checker {
            background-position: right center;
        }
        .navbar-default .navbar-nav>li>a, .navbar-default .navbar-text {
            color: #fff !important;
        }
        .navbar-nav>li>a:hover{
            background-color: #e24548 !important;
        }
        .marquee {
           /* padding: 5px 5px 5px 20px;*/
            background-color: #d9edf7;
        }
        .right_navigation li a{
                padding: 0;
                margin: 0;
                padding-left: 10px;
                color: #FF0000 !important;
                font-size: 14px;
        }
        .search_wrapper{
            top: 5px;
            background-color: #ffffffb3;
        }

        .right_navigation li a:hover{
            background-color:transparent !important;
            color:#5cb75c !important;
        }
        .marquee:before {
            content: 'News';
            position: absolute;
            z-index: 999;
            background: #5cb75c;
            color: #FFF;
            padding: 1px 15px;
        }
		.agent-leftside{
			border:1 px solid #333;
		}
		.agent-leftside h3{
			font-size:16px;
			background-color:#efefef;
			line-height:30px;
		}
		.agent-leftside h3,.agent-leftside p{
			padding:5px;
		}
		.nav-tabs .active a{
			background-color:#185c83 !important;
			color:white !important;
		}
        #floating-score{
        position: fixed;
        left: 0;
        top: 50%;
        width: 12em;
        margin-top: -2.5em;
        padding:20px 0 20px 20px;
        background-color:#185C83;
        color:white;
        font-weight:bold;
        font-size:16px;
        z-index:10000;
        }
        .agent-search-form{
            background-color:#057aba;
            padding:5px 0;
            color:white;
        }
        
    </style>

</head>

<body>
<?php 
use App\Options;
use App\Agentsbalance;
$amount=Agentsbalance::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->sum('amount');
?>

<!-- Floating score -->
<div id="floating-score">
    Your Balance:<br /> <?=$amount;?> TK
</div>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand biiss-lago" href="{{ url('/') }}"><img src="{{Request::root()}}/images/ticket/imgpsh_fullsize.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-11">
            <ul class="nav navbar-nav">
                
            </ul>

            <ul class="nav custom_contact navbar-nav navbar-right right_navigation" style="margin-top: 30px;">

                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" style="color: #5cb75c  !important;"><i class="fa fa-envelope" style="font-size:18px;"></i> Email@gmail.com</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" style="color: #5cb75c  !important;"><i class="fa fa-phone" style="font-size:18px;"></i> 0123456789</a></li>


                <!--<li><a href="{{ url('/print') }}">Wishlist ({{ Cart::instance('default')->count(false) }})</a></li>-->

               <!--  @if (Route::has('login'))

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
                        <li><a href="{{ url('/login') }}"><span class="forcolor"><i class="fa fa-user" aria-hidden="true"></i> Login</span></a></li>
                        @endif

                @endif -->




            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<nav class="navbar navbar-default p-0" style="background: #185c83;border-radius: 0px">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ request()->is('/agentdashbord') ? 'active' : '' }}"><a href="{{ url('/agentdashbord') }}">Dashboard<span class="sr-only">(current)</span></a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">My Profile</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Logout</a></li>         
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php
$bannerss= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();
?>
<div class="bnews" style="margin-bottom: -6px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 
				use App\Location;
				$locations = Location::pluck('name','name');
				?>
               
                {!! Form::open(array('route' => 'agentdashbord.searchticket','method'=>'GET','class'=>"form-inline agent-search-form")) !!}
                            <div class="row">
                               <div class="container">
                               <div class="col-md-12" style="text-align:center">
                                  <div class="form-group"  style="margin-right:20px;">
                                    <label for="exampleInputEmail1">Leaving From:</label>
                                     {!! Form::select('start_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                
                                  <div class="form-group" style="margin-right:20px;">
                                    <label for="exampleInputPassword1">Going To:</label>
                                     {!! Form::select('end_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                
                                  <div class="form-group ticket_custom_calader_icon"  style="margin-right:20px;">
                                    <label for="exampleInputEmail1">Date of Journey:</label>
                                    <input type="text" name="start_date" class="form-control" id="start_date" placeholder="Start Date">
                                  </div>
                                
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block" style=""><i class="fa fa-search"></i> Search Buses</button>
                                  </div>
                            </div>
                            </div>
                            </div>
                              
                           
                        {!! Form::close() !!}
            </div>
        </div>
    </div>
    
</div>

<style type="text/css">
    .bank-items ul li img{
        border-radius: 5px;
        box-shadow: 5px 3px 10px 1px #546d79;
    }
    .bank-items ul li{
       padding: 5px;
    }
    .border-top{
        border-top: 1px solid #cacaca;
        padding-top: 12px;
    }
</style>

 @yield('content')

<div class="bank-items">
    
    <h4 class="text-center text-uppercase">We Accept </h4>
    <div class="text-center border-top">
    <ul class="list-inline">
        <li><img src="{{Request::root()}}/images/payment_system/1.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/2.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/3.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/4.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/5.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/6.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/7.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/8.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/9.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/10.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/11.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/12.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/13.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/14.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/15.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/16.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/17.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/18.png" alt="" class="img-responsive" width="50" ></li>
        <li><img src="{{Request::root()}}/images/payment_system/19.png" alt="" class="img-responsive" width="50" ></li>
    </ul>
        <!-- <img src="{{Request::root()}}/images/payment_system/bank_logo.png" alt="" class="img-responsive" style="width: 100%;padding-bottom: 5px;"> -->
    </div>
                
            
</div>







<style>
   
</style>




<div class="bottom_navigation">
    <ul class="nav text-center">
        <li><a href="#">About Us</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Feedback</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
</div>
<div class="footer_area">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="footer_content_left">
                    <!--<a href="{{ url('/') }}"><img src="{{Request::root()}}/images/biiss.jpg"></a>-->
                    <p style="color: #FFF;">© <?php echo date('Y')?> Online Bus Tickets Booking System.</p>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
<!-- Bootstrap Core Js -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>


 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- jQuery news Ticker-->


  <script>
  $( function() {
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#return_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#start_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#return_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );


  </script>





@yield('ownjs')


</body>

</html>