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
</div>
@endsection


@section('ownjs')

@endsection