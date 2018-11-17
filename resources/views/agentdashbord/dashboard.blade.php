@extends('agentdashbord.app')
@section('owncss')


@endsection

@section('content')
<?php
use App\Agentsbalance;
use App\Agenttopsheet;
use App\Booking;
use App\User;
use App\Cancel;
//echo date('Y-m-d'); die();
$amount=Agentsbalance::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->sum('amount');
$todays_deposit=Agentsbalance::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->where('date_of_bill', date('Y-m-d'))
        ->sum('amount');
 $todays_total_sale=Booking::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->where('booking_date', date('Y-m-d'))
        ->sum('price');      
$todays_total_ticket=Booking::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->where('booking_date', date('Y-m-d'))
        ->sum('total_seat');   
 $Agenttopsheet=Agenttopsheet::where('agent_id', $member->id)->get()->first(); 
 $todays_sale_history=Booking::where('agent_id', $member->id)
        ->where('booking_date', date('Y-m-d'))
        ->get(); 
$all_sale_history=Booking::where('agent_id', $member->id)
        ->get();  

 $todays_cancel_history=Cancel::where('agent_id', $member->id)
        ->where('cancel_date', date('Y-m-d'))
        ->get(); 
$all_cancel_history=Cancel::where('agent_id', $member->id)
        ->get();           
//$user=User::find();              
?>
<div class="search_area_for_ticket">
    <div class="container">
        
            <div class="row">
				<div class="col-lg-3 agent-leftside">
				<h3>Total Sale</h3>
				<p><?=$Agenttopsheet->total_purchased_amount;?> TK</p>
				<h3>Today's Online Sale</h3>
				<p><?=$todays_total_sale;?></p>
				<h3>Todays Online Ticket Sale</h3>
				<p><?=$todays_total_ticket;?></p>
				<h3>Todays Total Ticket Sale</h3>
				<p><?=$todays_total_ticket;?></p>
				<h3>Todays Total Ticket Cancel</h3>
				<p>p</p>
				<h3>Todays Deposit</h3>
				<p><?=$todays_deposit;?> TK</p>
				</div>
                <div class="col-lg-9" style="padding-top:20px;">
					<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Today's Sale History</a></li>
    <li><a data-toggle="tab" href="#menu1">Today's Cancel History</a></li>
    <li><a data-toggle="tab" href="#menu2">All Sale History</a></li>
    <li><a data-toggle="tab" href="#menu3">All Cancel History</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    @if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	@if(session('error-message'))
	<div class='alert alert-warning'>
		{{ session('message') }}
	</div>
	@endif
      <table class="table table-bordered">
							
                                <tr>
                                    <th>Coach</th>
                                    <th>Company</th>
                                    <th>Seats</th>
                                    <th>Journey Date</th>
                                    <th>Purchase</th>
                                    <th>Passengers</th>
                                    <th>Mobile</th>
									<th>Rute</th>
                                    <th>Action</th>
                                </tr>
                               <?php
                                foreach($todays_sale_history as $sale):
                                ?>
                                <tr>
								<td>{{$sale->route_name}}</td>
								<td>{{$member->name}}</td>
								<td>{{$sale->seat_number}}</td>
								<td>{{$sale->booking_date}}</td>
								<td>{{$sale->price}}</td>
								<td>{{$sale->passenger_name}}</td>
								<td>{{$sale->passenger_mobile}}</td>
								<td>{{$sale->route_name}}</td>
                                <th>
                                {!! Form::open(['method' => 'get','route' => ['booking.cancel', $sale->id],'style'=>'display:inline', 'class'=>'delete']) !!}

                                {!! Form::submit('Cancel', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                </th>
								
								</tr>
                                <?php endforeach;?>
								</table>
    </div>
    <div id="menu1" class="tab-pane fade">
								<table class="table table-bordered">
							
                                <tr>
                                    <th>Coach</th>
                                    <th>Company</th>
                                    <th>Seats</th>
                                    <th>Journey Date</th>
                                    <th>Purchase</th>
                                    <th>Passengers</th>
                                    <th>Mobile</th>
									<th>Rute</th>
                                    
                                </tr>
                                <?php
                                foreach($all_cancel_history as $sale):
                                ?>
                                <tr>
								<td>{{$sale->route_name}}</td>
								<td>{{$member->name}}</td>
								<td>{{$sale->seat_number}}</td>
								<td>{{$sale->booking_date}}</td>
								<td>{{$sale->price}}</td>
								<td>{{$sale->passenger_name}}</td>
								<td>{{$sale->passenger_mobile}}</td>
								<td>{{$sale->route_name}}</td>
								
								</tr>
                                <?php endforeach;?>
								</table>
    </div>
    <div id="menu2" class="tab-pane fade">
								<table class="table table-bordered">
							
                                <tr>
                                    <th>Coach</th>
                                    <th>Company</th>
                                    <th>Seats</th>
                                    <th>Journey Date</th>
                                    <th>Purchase</th>
                                    <th>Passengers</th>
                                    <th>Mobile</th>
									<th>Rute</th>
                                </tr>
                                <?php
                                foreach($all_sale_history as $sale):
                                ?>
                                <tr>
								<td>{{$sale->route_name}}</td>
								<td>{{$member->name}}</td>
								<td>{{$sale->seat_number}}</td>
								<td>{{$sale->booking_date}}</td>
								<td>{{$sale->price}}</td>
								<td>{{$sale->passenger_name}}</td>
								<td>{{$sale->passenger_mobile}}</td>
								<td>{{$sale->route_name}}</td>
								
								</tr>
                                <?php endforeach;?>
								</table>
    </div>
    <div id="menu3" class="tab-pane fade">
								<table class="table table-bordered">
							
                                <tr>
                                    <th>Coach</th>
                                    <th>Company</th>
                                    <th>Seats</th>
                                    <th>Journey Date</th>
                                    <th>Purchase</th>
                                    <th>Passengers</th>
                                    <th>Mobile</th>
									<th>Rute</th>
                                </tr>
                                <?php
                                foreach($all_cancel_history as $sale):
                                ?>
                                <tr>
								<td>{{$sale->route_name}}</td>
								<td>{{$member->name}}</td>
								<td>{{$sale->seat_number}}</td>
								<td>{{$sale->booking_date}}</td>
								<td>{{$sale->price}}</td>
								<td>{{$sale->passenger_name}}</td>
								<td>{{$sale->passenger_mobile}}</td>
								<td>{{$sale->route_name}}</td>
								
								</tr>
                                <?php endforeach;?>
								</table>
    </div>
    
  </div>
                    <div class="agent_user_information">
                        
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
@endsection


@section('ownjs')
<script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to cancel this?");
        });
    </script>
@endsection
