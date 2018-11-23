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
    <link href="{{asset('/plugins/bxslider/jquery.bxslider.css')}}" rel="stylesheet">
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
            background-image: url({{asset('images/icon/demo.png')}});
            background-position: left center;
            background-size: auto 100%;
            width: 40px;
            height: 40px;
            background-repeat: no-repeat;
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
        .navbar-collapse {
            padding-left: 0px;
        }
        .marquee {
           /* padding: 5px 5px 5px 20px;*/
            background-color: #d9edf7;
        }
        .top_navigation{
            padding: 10px 0px;
        }
        .biiss-lago{
            float: left;
        }
        .right_navigation{
            float: right;
        }
        .right_navigation li{
            padding: 0 5px 5px 0px;
        }
        .right_navigation li a{
                padding: 0;
                margin: 0;
                padding-left: 10px;
                color: #FF0000 !important;
                font-size: 14px;
        }

        .right_navigation li a i{
            font-size:18px;
            color: #5cb75c !important;
            
        }
        
        .search_wrapper{
            top: 5px;
            background-color: #fff;
            border:2px solid #ccc;
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
        .marquee ul li{
            font-size: 16px;
            font-weight: bold;
            color: #f91919;
            padding:0px 40px;
        }

        .ticket_header_filter_area{
            /*margin-top: 50px;*/
            position: relative;
            top: -375px;
            z-index: 999;
            margin-bottom: -376px;

        }
        .bx-controls{
            display: none;
        }

        
@media (min-width: 768px){
    /*.ticket_header_filter_area{
        position: unset;
        top: 0;
        z-index: 999;
        margin-bottom: 0px;

    }*/
}
@media (max-width: 768px){
.ticket_header_filter_area{
        position: unset;
        top: 0;
        z-index: 999;
        margin-bottom: 0px;

    }
    .logo{
        height: 50px;
        width: 120px;
    }
    .navbar-nav {
        margin: 0.5px -15px;
    }
    .navbar-brand {
        padding: 0 0 0 5px;
    }
    .marquee ul li{
        font-size: 12px;
        font-weight: bold;
        color: #f91919;
        padding:0px 20px;
    }
    .marquee:before {
        content: 'News';
        position: absolute;
        z-index: 999;
        background: #5cb75c;
        color: #FFF;
        padding: 0px 15px;
    }
    .right_navigation li a i{
        font-size:18px;
        color: #5cb75c !important;
        width: 18px !important;
        height: 18px !important;
    }
}
@media (min-width: 1200px){
    .bx-wrapper img {
        height: 450px;
    }
    .ticket_header_filter_area{
        position: relative;
        top: -375px;
        z-index: 999;
        margin-bottom: -376px;
    }
    
        
}
.thumbnail{
    max-height:300px !important;
    min-height:300px !important;
    padding:25% 1%;
    text-align:center;
    font-size:40px;
    background-color:#d9edf7;
}

</style>

</head>

<body>
<!-- help modal -->
<!--modal-->
                <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#5cb75c; text-align:center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color:white">How to buy bus ticket?</h4>
                          </div>
                          <div class="modal-body">
                          <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <a href="#" onclick="$('#helpModal').modal('hide');$('#helpModal-buyonline').modal('show');"  class="thumbnail">
                                    Buy ticket from <br/> online
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <a href="#" onclick="$('#helpModal').modal('hide');$('#helpModal-buyagent').modal('show');" class="thumbnail">
                                    Buy ticket from <br />agent
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <a href="#" onclick="$('#helpModal').modal('hide');$('#helpModal-buycallcenter').modal('show');" class="thumbnail">
                                    Buy ticket from <br />call center
                                </a>
                            </div>

                            </div>

                             
                          </div>
                          
                        </div>
                    </div>
                </div>
<!-- modal -->      

<!--modal-->
                <div class="modal fade" id="helpModal-buyonline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#5cb75c; text-align:center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color:white">How to buy bus ticket?</h4>
                          </div>
                          <div class="modal-body">
                          <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <a href="#" class="thumbnail">
                                    Buy ticket from <br/> online
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-8" style="background-color:#d9edf7;max-height:300px;overflow-y: scroll;">
                                <p >
                                   <ol>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>

                                   </ol>
                                </p>
                            </div>
                            

                            </div>

                             
                          </div>
                          
                        </div>
                    </div>
                </div>
<!-- modal -->   

<!--modal-->
                <div class="modal fade" id="helpModal-buyagent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#5cb75c; text-align:center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color:white">How to buy bus ticket?</h4>
                          </div>
                          <div class="modal-body">
                          <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <a href="#" class="thumbnail">
                                    Buy ticket from <br/> agent
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-8" style="background-color:#d9edf7;max-height:300px;overflow-y: scroll;">
                                <p >
                                   <ol>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>

                                   </ol>
                                </p>
                            </div>
                            

                            </div>

                             
                          </div>
                          
                        </div>
                    </div>
                </div>
<!-- modal -->            


<!--modal-->
                <div class="modal fade" id="helpModal-buycallcenter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#5cb75c; text-align:center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color:white">How to buy bus ticket?</h4>
                          </div>
                          <div class="modal-body">
                          <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <a href="#" class="thumbnail">
                                    Buy ticket from <br/> call center
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-8" style="background-color:#d9edf7;max-height:300px;overflow-y: scroll;">
                                <p >
                                   <ol>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>
                                    <li style="border-bottom:1px solid white; margin-bottom:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </li>

                                   </ol>
                                </p>
                            </div>
                            

                            </div>

                             
                          </div>
                          
                        </div>
                    </div>
                </div>
<!-- modal -->  
<hr style="padding: 0px;border: .5px solid #e24648;margin:0px;">

<nav class="navbar navbar-default top_navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="float: left;">
            <?php
            $logo=App\Options::where('details','Logo')->get()->first();
            if($logo)
            {
            ?>

            <a class="navbar-brand biiss-lago" href="{{ url('/') }}"><img src="{{Request::root()}}/uploads/banners/{{$logo->value}}" class="logo"></a>

            <?php
            }else{
            ?>
            <a class="navbar-brand biiss-lago" href="{{ url('/') }}"><img src="{{Request::root()}}/images/ticket/imgpsh_fullsize.png" class="logo"></a>
            <?php
            }
            ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        
            

            <ul class="nav navbar-nav navbar-right right_navigation">

                <li class=""><a href="#" style="color:#FF0000 !important;"><i class="fa fa-envelope" style=""></i> albarakaexclusive@gmail.com</a></li>
                <li class=""><a href="#" style="color:#FF0000 !important;"><i class="fa fa-phone" style=""></i> 01733376701-4</a></li>
               


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

                @endif
 -->



            </ul>
        
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
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a></li>

                
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{route('passenger.create')}}">Create Account</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Cancel Ticket</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Complain</a></li>
                <li ><a href="javascript:void(0)" onclick="$('#helpModal').modal('show');">Help</a></li>
                
            </ul>

        

            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="{{ url('/print') }}">Wishlist ({{ Cart::instance('default')->count(false) }})</a></li>-->

                @if (Route::has('login'))

                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="forcolor"> <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span></span></a>
                                <ul class="dropdown-menu">
                                    

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
                        <li><a href="{{ url('/login') }}"><span class="forcolor"><i class="fa fa-user" aria-hidden="true"></i> Sign In</span></a></li>
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

<div class="bnews" style="margin-bottom: -6px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <marquee behavior="" direction="" class="marquee">
                <ul class="list-inline" style="margin-bottom: 0px;">
                <?php 
                use App\Albarakanews;
                $abnews = Albarakanews::where('status','1')->get();
                $count = 0;
                $i =count($abnews);
                //dd($i);
                ?>
                @foreach($abnews as $news)
                <?php $count++;?>
                    <li style="">{{ $news->title }} </li><?php if($count<$i){echo '|';} ?>
                @endforeach
                </ul>
                    
                    
                </marquee>
            </div>
        </div>
    </div>
    
</div>
<!-- <div class="ticket_header_shadow_area">
        <img src="{{Request::root()}}/images/ticket/shadow.png" style="width:100%">
</div> -->


<!-- <div id="slider" class="nivoSlider">
    <img src="http://localhost:8000/images/image-gallery/slider4.jpg" alt="" />
    <img src="http://localhost:8000/images/image-gallery/slider5.jpg" alt="" />
    <img src="http://localhost:8000/images/image-gallery/slider6.jpg" alt="" />
</div> -->
@yield('slider')


<div class="search_area_for_ticket">
    <div class="container">
        
       @yield('content')
            
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

<div class="ticket_footer_top_are">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket_footer_top">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="text-center">
                            <h2>Our Routes & Check-Points</h2>
                        </div><hr>
                            <h3 class="label label-primary" style="font-size: 100%;">Route: Ramganj - Tongi</h3>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <ul class="list-inline">
                                        <li class="label label-success">Ramganj Counter</li>
                                        <li class="label label-success">Baluya Chowmuhuni</li>
                                        <li class="label label-success">Alipur</li>
                                        <li class="label label-success">Kachua Bazar</li>
                                        <li class="label label-success">Dashgharia</li>
                                        <li class="label label-success">Chatkhil</li>
                                        <li class="label label-success">Halima Dighir Par</li>
                                        <li class="label label-success">Joyag</li>
                                        <li class="label label-success">Bawor Court</li>
                                        <li class="label label-success">Junudpur</li>
                                        <li class="label label-success">Banglabazar</li>
                                        <li class="label label-success">Sonaimuri</li>
                                        <li class="label label-success">Sonaimuri Baipass</li>
                                        <li class="label label-success">Sonaimuri Chatarpyia</li>
                                        <li class="label label-success">Bipulsar</li>
                                        <li class="label label-success">Nather Petuya</li>
                                        <li class="label label-success">Chandina</li>
                                        <li class="label label-success">Chittagong Road</li>
                                        <li class="label label-success">Signboard</li>
                                        <li class="label label-success">ShanirAkhra</li>
                                        <li class="label label-success">Saydabad</li>
                                        <li class="label label-success">Maniknagar</li>
                                        <li class="label label-success">Malibagh</li>
                                        <li class="label label-success">Kuril Biswaroad</li>
                                        <li class="label label-success">Airport</li>
                                        <li class="label label-success">Uttara</li>
                                        <li class="label label-success">Tongi</li>
                                    </ul>
                                </div>
                            </div>
                               
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="label label-primary" style="font-size: 100%;">Route: Tongi - Ramganj</h3>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <ul class="list-inline">
                                        <li class="label label-success">Tongi</li>
                                        <li class="label label-success">Uttara</li>
                                        <li class="label label-success">Airport</li>
                                        <li class="label label-success">Kuril Biswaroad</li>
                                        <li class="label label-success">Malibagh</li>
                                        <li class="label label-success">Maniknagar</li>
                                        <li class="label label-success">Saydabad</li>
                                        <li class="label label-success">ShanirAkhra</li>
                                        <li class="label label-success">Signboard</li>
                                        <li class="label label-success">Chittagong Road</li>
                                        <li class="label label-success">Chandina</li>
                                        <li class="label label-success">Nather Petuya</li>
                                        <li class="label label-success">Bipulsar</li>
                                        <li class="label label-success">Sonaimuri Chatarpyia</li>
                                        <li class="label label-success">Sonaimuri Baipass</li>
                                        <li class="label label-success">Sonaimuri</li>
                                        <li class="label label-success">Banglabazar</li>
                                        <li class="label label-success">Junudpur</li>
                                        <li class="label label-success">Bawor Court</li>
                                        <li class="label label-success">Joyag</li>
                                        <li class="label label-success">Halima Dighir Par</li>
                                        <li class="label label-success">Chatkhil</li>
                                        <li class="label label-success">Dashgharia</li>
                                        <li class="label label-success">Kachua Bazar</li>
                                        <li class="label label-success">Alipur</li>
                                        <li class="label label-success">Baluya Chowmuhuni</li>
                                        <li class="label label-success">Ramganj Counter</li>
                                    </ul>
                                </div>
                            </div>
                               
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="label label-primary" style="font-size: 100%;">Route: Ramganj - Mirpur</h3>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <ul class="list-inline">
                                        <li class="label label-success">Ramganj Counter</li>
                                        <li class="label label-success">Baluya Chowmuhuni</li>
                                        <li class="label label-success">Alipur</li>
                                        <li class="label label-success">Kachua Bazar</li>
                                        <li class="label label-success">Dashgharia</li>
                                        <li class="label label-success">Chatkhil</li>
                                        <li class="label label-success">Halima Dighir Par</li>
                                        <li class="label label-success">Joyag</li>
                                        <li class="label label-success">Bawor Court</li>
                                        <li class="label label-success">Junudpur</li>
                                        <li class="label label-success">Banglabazar</li>
                                        <li class="label label-success">Sonaimuri</li>
                                        <li class="label label-success">Sonaimuri Baipass</li>
                                        <li class="label label-success">Sonaimuri Chatarpyia</li>
                                        <li class="label label-success">Bipulsar</li>
                                        <li class="label label-success">Nather Petuya</li>
                                        <li class="label label-success">....</li>
                                        <li class="label label-success">Mirpur-1</li>
                                        <li class="label label-success">Mirpur-10</li>
                                    </ul>
                                </div>
                            </div>
                               
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="label label-primary" style="font-size: 100%;">Route: Mirpur - Ramganj</h3>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <ul class="list-inline">
                                        <li class="label label-success">Mirpur-10</li>
                                        <li class="label label-success">Mirpur-1</li>
                                        <li class="label label-success">....</li>
                                        <li class="label label-success">Nather Petuya</li>
                                        <li class="label label-success">Bipulsar</li>
                                        <li class="label label-success">Sonaimuri Chatarpyia</li>
                                        <li class="label label-success">Sonaimuri Baipass</li>
                                        <li class="label label-success">Sonaimuri</li>
                                        <li class="label label-success">Banglabazar</li>
                                        <li class="label label-success">Junudpur</li>
                                        <li class="label label-success">Bawor Court</li>
                                        <li class="label label-success">Joyag</li>
                                        <li class="label label-success">Halima Dighir Par</li>
                                        <li class="label label-success">Chatkhil</li>
                                        <li class="label label-success">Dashgharia</li>
                                        <li class="label label-success">Kachua Bazar</li>
                                        <li class="label label-success">Alipur</li>
                                        <li class="label label-success">Baluya Chowmuhuni</li>
                                        <li class="label label-success">Ramganj Counter</li>
                                    </ul>
                                </div>
                            </div>
                               
                        </div>
                    </div>
                    <hr>
                </div>   
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
        <li><a href="{{route('about_us')}}">About Us</a></li>
        <li><a href="{{route('faqs')}}">FAQs</a></li>
        <li><a href="{{route('terms_and_conditions')}}">Terms & Conditions</a></li>
        <li><a href="{{route('terms_of_use')}}">Terms of Use</a></li>
        <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
        <li><a href="{{route('feedback')}}">Feedback</a></li>
        <li><a href="{{route('contact')}}">Contact Us</a></li>
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
<script src="{{asset('/plugins/bxslider/jquery.bxslider.js')}}"></script>


 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- jQuery news Ticker-->


  <script>
  $( function() {
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#return_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#start_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#return_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );


  </script>

<script type="text/javascript">


$(document).ready(function(){
        $('.bxslider').bxSlider({
            mode: 'fade',
            moveSlides: 1,
            slideMargin: 40,
            infiniteLoop: true,
            slideWidth: 'auto',
            minSlides: 3,
            maxSlides: 3,
            speed: 800,
            auto:true,
        });
    });
</script>

</script>
<script>

    function readURL(input) {

        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
     });

  </script>

  <script type="text/javascript">
      $(document).on('click','#user_reg',function(e){
        e.preventDefault();
        var url = "{{route('passenger.create')}}";
        $.ajax({
            method: 'get',
            url: url,
            data:{"_token": "{{ csrf_token() }}"},
            dataType:'json',
            success:function(data){
                console.log(data[0].id);
                $('#type').val(data[0].id);
            }
        })
      })
  </script>




@yield('ownjs')


</body>


</html>