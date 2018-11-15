@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/tinymce/parsley.css') }}" />
    <link rel="stylesheet" href="{{asset('/css/tagInput.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')




<?php
use App\Options;



use App\Agentsbalance;


$bannerss= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();


?>

<div class="bnews" style="margin-bottom: -6px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <marquee behavior="" direction="" class="marquee">
                    <span style="font-size: 16px;font-weight: bold;color: #f91919;">Welcome to Al-Baraka Exclusive LTD.</span>
                </marquee>
            </div>
        </div>
    </div>
    
</div>







<div class="search_area_for_ticket">
    <div class="container">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="agent_user_information">
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

                                              $amount=Agentsbalance::groupBy('agent_id')
                                               ->where('agent_id', $member->id)
                                               ->sum('amount');
                                               echo $amount;
                                            ?>
                                             

                                        </td>




                                        
                                    </tr>
                               
                            </table>
                    </div>
                </div>
            </div>        
            
    </div> 
</div> 


@endsection