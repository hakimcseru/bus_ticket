@extends('layouts.app')

@section('owncss')
   <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
   <link rel="stylesheet" href="{{asset('/css/select2.min.css') }}" />

   <style>
   .ticket_sidebar{text-align: center;}
   .ticket_sidebar i{
        color: #45c203;
        font-size: 35px;
   }
   .ticket_sidebar p{
         color: #45c203;
      
   }

   .card .ticket_sidebar {
    
    padding: 35px !important;
   }
   .ticket_admin_panel{
    border-bottom: 1px solid #45c203;
    margin-bottom: 25px;
   }
   .ticket_admin_panel h3{

   }
   </style>
@endsection

@section('content')




         
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ticket_admin_panel">
                            <h4>Welcome Back! Administrator User</h4>
                        </div>    
                </div>
            </div>        
            
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body ticket_sidebar">
                            <i class="fa fa-ticket" aria-hidden="true"></i>
                            <p>Booking</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body ticket_sidebar">
                            <i class="fa fa-pie-chart" aria-hidden="true"></i>
                             <p>Reaport</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body ticket_sidebar">
                            <i class="fa fa-money" aria-hidden="true"></i>
                             <p>Account Transaction</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>LAST YEAR PROGRESS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
                <!-- Bar Chart -->
               
                <!-- #END# Bar Chart -->
            </div>

           
      
 


@endsection




@section('ownjs')
    <script src="{{asset('/plugins/chartjs/Chart.bundle.js')}}"></script>
    <script src="{{asset('/js/pages/charts/chartjs.js')}}"></script>
@endsection
