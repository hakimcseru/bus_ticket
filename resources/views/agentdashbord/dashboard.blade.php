@extends('agentdashbord.app')
@section('owncss')


@endsection

@section('content')
<?php
use App\Agentsbalance;
$amount=Agentsbalance::groupBy('agent_id')
        ->where('agent_id', $member->id)
        ->sum('amount');
?>
<div class="search_area_for_ticket">
    <div class="container">
        
            <div class="row">
				<div class="col-lg-3 agent-leftside">
				<h3>Total Sale</h3>
				<p>p</p>
				<h3>Today's Online Sale</h3>
				<p>p</p>
				<h3>Todays Online Ticket Sale</h3>
				<p>p</p>
				<h3>Todays Total Ticket Sale</h3>
				<p>p</p>
				<h3>Todays Total Ticket Cancel</h3>
				<p>p</p>
				<h3>Todays Deposit</h3>
				<p>p</p>
				</div>
                <div class="col-lg-9" style="padding-top:20px;">
					<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Today's Sale History</a></li>
    <li><a data-toggle="tab" href="#menu1">Today's Cancel History</a></li>
    <li><a data-toggle="tab" href="#menu2">Todays Migrated History</a></li>
    <li><a data-toggle="tab" href="#menu3">Today's Online History</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Agent Information</h3>

                            <table class="table table-bordered">
							
                                <tr>
                                   
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Roles</th>
                                   
                                    <th>Address</th>
                                    <th>Avatar</th>
                                    <th>Total Amount</th>
                                  
                                </tr>
                               
                                    <tr>
                                       
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->contact_number }}</td>
                                        <td>
                                            @if(!empty($member->roles))
                                                @foreach($member->roles as $v)
                                                    <label class="label label-success">{{ $v->display_name }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                       

                                        <td>{{ $member->address }}</td>
                                        <td><img src="{{Request::root()}}/uploads/profile/{{ $member->avatar }}" width="60" height="45"></td>
                                        <td>
                                            <?php

                                              
                                               echo $amount;
                                            ?>
                                             

                                        </td>

                                        
                                    </tr>
                               
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
                                <tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								
								</tr>
								</table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
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

@endsection
