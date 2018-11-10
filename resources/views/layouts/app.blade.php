<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Online Bus Ticketing System</title>

   

    <link rel=icon"" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('/font-awesome/4.5.0/css/font-awesome.min.css') }}" />


    <link href="{{asset('/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

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

 [type="checkbox"] + label:before, [type="checkbox"]:not(.filled-in) + label:after{
     border:0 !important;
 } 
 .floatrightcon{
     padding-left:0 !important;
 }      
 .modal-body{
    overflow: scroll;
    max-height: 600px;
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
 </style>


    <link href="{{asset('//plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />


    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('/css/themes/all-themes.css')}}" rel="stylesheet" />



    @yield('owncss')
</head>

<body class="theme-red">



<?php
use Illuminate\Support\Facades\Auth;
use App\Permission;
use App\User;
use App\Employee;
?>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>

<div class="overlay"></div>

<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>

<nav class="navbar">
    <div class="container-fluid ticket_system_admin_header">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{Request::root()}}/dashboard"><!--<img src="{{Request::root()}}/images/ticket/logo_admin.jpg">-->Aalbaraka Exclusive Ltd</a>
            <?php

            ?>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">




                <li class="dropdown profile_image">


                    {{ Auth::user()->name }}


                    <?php
                        $user_other_info = User::where('id',Auth::user()->id)->first();

                        if($user_other_info->avatar!=''){?>
                           <img data-toggle="dropdown"  src="{{Request::root()}}/uploads/profile/{{ $user_other_info->avatar }}" width="48" height="48" alt="User" >
                       <?php }else{?>
                           <img data-toggle="dropdown"  src="{{Request::root()}}/images/user.png" width="48" height="48" alt="User" />
                       <?php }
                    ?>



                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('users.show',Auth::user()->id) }}"><i class="material-icons">person</i>Profile</a></li>


                        <li role="seperator" class="divider"></li>
                        <li>
                            <a href="#">
                                <i class="material-icons">input</i>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="float: left;background: #fff;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="" style="border: medium none;background: #fff;">Log Out</button>
                                </form>

                            </a>
                        </li>
                    </ul>

                </li>

            </ul>
        </div>
    </div>
</nav>

<section>
 
    <aside id="leftsidebar" class="sidebar">


        <?php


        $currentPath = Request::path();

        $currentPathvalue = explode("/", $currentPath);
   

        ?>
        <div class="menu">
            <ul class="list">
                
                <li class="<?php if(count($currentPathvalue)==1){ echo 'active homeactive'; } ?>">
                     <a href="{{Request::root()}}/dashboard">
                            <span> <img class="custom_nab_image" src="{{Request::root()}}/images/icon/navbar/employeemanagement.png" >Dashboard</span>
                     </a>
                </li>
             <?php
                $permission = Permission::where("super_parent", null)->where("is_active",'1')->orderBy('sno','asc')->get();
                foreach ($permission as $singleparent){
                    $children[$singleparent->name]=Permission::where("parent_id", $singleparent->id)->get();
                }

                $auth_user=Auth::user()->roles;
                $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$auth_user[0]->id)
                    ->pluck('permission_role.permission_id','permission_role.permission_id')->toArray();



                $checkvalue=false;
                foreach($permission as $value){

                    $haspermission = Permission::where("parent_id", $value->id)->get();
                    foreach ($haspermission as $haspermission_single){
                        if(in_array($haspermission_single->id, $rolePermissions)){
                            $checkvalue=true;
                            break;
                        }
                    }

                    if($checkvalue){
                    ?>
                       <li <?php

                           if(isset($currentPathvalue[1])){ if($currentPathvalue[1]==$value->name){echo 'class="active"';}}
                           if(isset($currentPathvalue[1])){
                               $findcurrenturl = Permission::where("url", '=', $currentPathvalue[1])->where("is_active",'1')->first();
                               if(sizeof($findcurrenturl)>0){

                                 if($findcurrenturl->super_parent==$value->id){
                                     echo 'class="active"';
                                 }


                               }
                           }

                           ?>>
                         <a href="{{Request::root()}}/dashboard/<?php echo $value->name; ?>">

                              <span> <img class="custom_nab_image" src="{{Request::root()}}/images/icon/navbar/<?php echo $value->description; ?>" > <?php echo $value->display_name; ?></span>
                         </a>
                      </li>
                    <?php
                    }

                    $checkvalue=false;
                }

                ?>
                 <li class="<?php if(count($currentPathvalue)==1){ echo 'active homeactive'; } ?>">
                     <a href="{{Request::root()}}/user/todaystransaction">
                            <span> <img class="custom_nab_image" src="{{Request::root()}}/images/icon/navbar/employeemanagement.png" >Todays Transaction</span>
                     </a>
                </li>
                <li class="<?php if(count($currentPathvalue)==1){ echo 'active homeactive'; } ?>">
                     <a href="{{Request::root()}}/user/alltransaction">
                            <span> <img class="custom_nab_image" src="{{Request::root()}}/images/icon/navbar/employeemanagement.png" >All Transaction</span>
                     </a>
                </li>
                <li class="<?php if(count($currentPathvalue)==1){ echo 'active homeactive'; } ?>">
                     <a href="{{Request::root()}}/user/history">
                            <span> <img class="custom_nab_image" src="{{Request::root()}}/images/icon/navbar/employeemanagement.png" >History</span>
                     </a>
                </li>
             </ul>
        </div>
     
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);"> Bus Tickets &copy; <?php echo date('Y')?> </a>.
            </div>

        </div>
      
    </aside>
 
  
</section>

<section class="content">
    <div class="container-fluid">


        @yield('content')


    </div>
</section>



<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('/plugins/node-waves/waves.js')}}"></script>
<script src="{{asset('/js/admin.js')}}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<script>
  $( function() {
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#return_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#start_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#return_date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>











@yield('ownjs')


</body>

</html>