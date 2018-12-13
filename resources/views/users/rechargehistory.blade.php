@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/css/select2.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{asset('/tagged/css/taggle.css') }}">
    <style>
        .show_images img{
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Recharge History</h2>
            </div>
            
        </div>
        <?php $refill_history=App\Agentsbalance::get();?>
<table id="myTable" class="table table-striped table-bordered" style="width:100%; background-color:white" >
                            <thead>
                                <tr>
                                    <th>Date of refill</th>
                                    <th>Agent</th>
                                    <th>Refill by</th>
                                    <th>Contact no</th>
                                    <th>Deposit amount</th>
                                    <th>Per ticket discount</th>
                                    <th>Ticket amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($refill_history as $rhistory):
                                ?>
                                <tr>
								<td>{{$rhistory->date_of_bill}}</td>
                                <td>{{$rhistory->agent?$rhistory->agent->name:""}}</td>
                                
								<td>{{$rhistory->name}}</td>
								<td>{{$rhistory->contact_number}}</td>
								<td>{{$rhistory->amount}}</td>
								<td>{{$rhistory->per_ticket_discount}}</td>
								<td>{{$rhistory->ticket_amount}}</td>
								</tr>
                                <?php endforeach;?>
                            </tbody>
                        <tfoot>
                            <tr>
                                    <th>Date of refill</th>
                                    <th>Agent</th>
                                    <th>Refill by</th>
                                    <th>Contact no</th>
                                    <th>Deposit amount</th>
                                    <th>Per ticket discount</th>
                                    <th>Ticket amount</th>
                                </tr>
                                </tfoot>
							</table>


@endsection