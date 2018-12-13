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
                <h2>All Transaction Report</h2>
            </div>
            
        </div>
<table id="myTable" class="table table-striped table-bordered" style="width:100%; background-color:white" >
        <thead>
            <tr>
                <th>SN</th>
                <th>Route</th>
                <th>Booking Date</th>
                <th>Total Seat</th>
                <th>Seat Number</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>Status</th>
                <th>Order Status</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
        $data=App\Booking::get();
        $i=1;
        foreach($data as $d):
        ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$d->route_name}}</td>
                <td>{{$d->booking_date}}</td>
                <td>{{$d->total_seat}}</td>
                <td>{{$d->seat_number}}</td>
                <td>{{$d->price}}</td>
                <td>{{$d->discount}}</td>
                <td>{{$d->pickup_location}}</td>
                <td>{{$d->drop_location}}</td>
                <td>{{$d->status}}</td>
                <td>{{$d->order_status}}</td>
                
            </tr>
            <?php endforeach;?>

            
        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Route</th>
                <th>Booking Date</th>
                <th>Total Seat</th>
                <th>Seat Number</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>Status</th>
                <th>Order Status</th>
            </tr>
        </tfoot>
    </table>

@endsection