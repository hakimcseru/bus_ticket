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
    </style>

</head>

<body>



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

            <ul class="nav custom_contact navbar-nav navbar-right right_navigation" style="margin-top: 10px;">

                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" style="color: #ff0003 !important;margin-top: 20px;"><i class="fa fa-envelope" style="font-size:18px;color: #5cb75c;"></i> albarakaexclusive@gmail.com</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" style="color: #ff0003 !important;"><i class="fa fa-phone" style="font-size:18px;color: #5cb75c;"></i> 01733376701 <br><i class="fa fa-phone" style="font-size:18px;color: #5cb75c;"></i> 01733376702</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" style="color: #ff0003 !important;"><i class="fa fa-phone" style="font-size:18px;color: #5cb75c;"></i> 01733376703 <br><i class="fa fa-phone" style="font-size:18px;color: #5cb75c;"></i> 01733376704</a></li>


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
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a></li>

                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Agent List</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Agent Registration</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Complain</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/dashboard') }}">Sign In</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Create Account</a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="#">Cancel Ticket</a></li>
                

            </ul>

            <ul class="nav navbar-nav navbar-right">
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
                $count = 0;
                $i =count($abnews);
                //dd($i);
                ?>
                @foreach($abnews as $news)
                <?php $count++;?>
                    <li style="font-size: 16px;font-weight: bold;color: #f91919; padding:0px 40px;">{{ $news->title }} </li><?php if($count<$i){echo '|';} ?>
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

<style type="text/css">
/*    body{
  font-family: 'Lato', sans-serif;
}
.carousel-fade .carousel-inner .item {
  opacity: 0;
  transition-property: opacity;
}

.carousel-fade .carousel-inner .active {
  opacity: 1;
}

.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  opacity: 0;
  z-index: 1;
}

.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}

.carousel-fade .carousel-control {
  z-index: 2;
} 
@media all and (transform-3d), (-webkit-transform-3d) {
    .carousel-fade .carousel-inner > .item.next,
    .carousel-fade .carousel-inner > .item.active.right {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.prev,
    .carousel-fade .carousel-inner > .item.active.left {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.next.left,
    .carousel-fade .carousel-inner > .item.prev.right,
    .carousel-fade .carousel-inner > .item.active {
      opacity: 1;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
} 
.carousel-caption {
    text-shadow: 0 1px 4px rgba(0,0,0,.9);
  font-size:17px
}
.carousel-caption h3 {
  font-size: 30px;
  font-family: 'Lato', sans-serif;
}
    html,
    body,
    .carousel,
    .carousel-inner,
    .carousel-inner .item {
      height: 100%;
    } 
    .item:nth-child(1) {
      background: url('https://snap-photos.s3.amazonaws.com/img-thumbs/960w/HZZKGVVJ6I.jpg');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
    }

    .item:nth-child(2) {
      background: url('https://snap-photos.s3.amazonaws.com/img-thumbs/960w/D2ROMCUEIV.jpg');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
    }

    .item:nth-child(3) {
      background: url('https://snap-photos.s3.amazonaws.com/img-thumbs/960w/PU9HHZB5QW.jpg');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
    }*/
</style>
{{-- <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">--}}

    <!-- Wrapper for slides -->
   {{-- <div class="carousel-inner" role="listbox">
        <div class="item active">  
            <div class="carousel-caption">
              <h3>First slide label</h3>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
        <div class="item"> 
            <div class="carousel-caption">
              <h3>Second slide label</h3>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
        <div class="item"> 
            <div class="carousel-caption">
              <h3>Third slide label</h3>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>--}}

    <!-- Controls -->
    {{-- <a class="left carousel-control" href="#carouselFade" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carouselFade" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div> --}}

<?php $data = array(Request::root().'/images/ticket/header_img.png',Request::root().'/images/ticket/header_img.png',Request::root().'/images/ticket/header_img.png' ); 
//dd($data);
?>

<div class="ticket_header_filter_area" style="background-image: url({{Request::root()}}/images/ticket/header_img.png);
    background-repeat: no-repeat, repeat;
    background-size: cover;
    background-position: center;
    background-position: 100% 100%;
    padding: 130px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 search_wrapper">
                <div class="ticket_header_filter ticket_header_filter_left">
                        <h4  style="
    text-align: center;
    color: #e34b4d;
">Online Bus Tickets Booking with Zero Booking Fees</h4>
                         {!! Form::open(array('route' => 'font_web.index','method'=>'GET')) !!}
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">From</label>
                                    
                                     {!! Form::select('start_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">To</label>
                                    
                                     {!! Form::select('end_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputEmail1">Date of Journey</label>
                                    <input type="text" name="start_date" class="form-control" id="start_date" placeholder="Start Date">
                                      <i class="fa fa-calendar" id="start_date5" aria-hidden="true"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputPassword1">Date of Return (Optional)</label>
                                    <input type="text" name="return_date" class="form-control" id="return_date" placeholder="Return Date">
                                    <i class="fa fa-calendar" id="return_date1" aria-hidden="true"></i>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                   <button type="reset" class="btn btn-danger" style="width:150px">Reset</button>
                                  </div>
                                </div> --}}
                                <div class="col-lg-6 col-xs-6 col-md-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-3">
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block" style=""><i class="fa fa-search"></i> Search Buses</button>
                                  </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                <div class="ticket_header_filter">
                      {{--<img  style="width: 73%;float: right;padding-top: 35px;" src="{{Request::root()}}/images/ticket/bus_transparent.png">--}}
                </div>
            </div>
        </div>
    </div>
</div>





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
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#return_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#start_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#return_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );


  </script>
  <script type="text/javascript">
      $(function(){
        $('#carouselFade').carousel();
      })
  </script>


<script type="text/javascript">
  //Preload images first 
// $.fn.preload = function() {
//     this.each(function(){
//         $('<img/>')[0].src = this;
//     });
// }
var images = Array("http://localhost:8000/images/ticket/header_img.png",
                   "http://localhost:8000/images/image-gallery/slider4.jpg",
                   "http://localhost:8000/images/image-gallery/slider5.jpg",
                   "http://localhost:8000/images/image-gallery/slider6.jpg");

//$([images[0],images[1],images[2],images[3]]).preload();

// Usage:

var currimg = 0;

$(document).ready(function(){
   
    function loadimg(){
        
       $('.ticket_header_filter_area').fadeIn(5000,function(){

            //finished animating, minifade out and fade new back in           
            $('.ticket_header_filter_area').fadeOut(5000,function(){
                
                currimg++;
                
                if(currimg > images.length-1){
                    
                    currimg=0;
                    
                }
                
                var newimage = images[currimg];
            
                //swap out bg src                
                $('.ticket_header_filter_area').css("background-image", "url("+newimage+")"); 
            
                //animate fully back in
                $('.ticket_header_filter_area').fadeOut(5000,function(){

                    //set timer for next
                    setTimeout(loadimg,5000);

                });

            });
        
        });

     }
     setTimeout(loadimg,5000);
  
});
</script>


@yield('ownjs')


</body>

</html>
var data = array('http://localhost:8000/images/ticket/header_img.png','http://localhost:8000/images/ticket/header_mg.png','http://localhost:8000/images/ticket/header_img.png' );