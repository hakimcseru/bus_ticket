@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Booking list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('booking.create') }}"> Create new Booking</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'booking.index','method'=>'GET')) !!}
            <div class="input-group">
                {!! Form::text('search', null, array('placeholder' => 'Search for...','class' => 'form-control')) !!}
                <span class="input-group-btn">
                 {!! Form::submit('Go!', ['class' => 'btn btn-default']) !!}
                </span>
            </div><!-- /input-group -->
            {!! Form::close() !!}
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <!----------------------search end-------------------------->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Booking Id</th>
                        <th>Route name</th>
                        <th>booking_date</th>
                        <th>user_id</th>

                        <th>total_seat</th>
                        <th>seat_number</th>
                        <th>discount</th>
                        <th>price</th>
                        <th>pickup_location</th>
                        <th>drop_location</th>
                      
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($bookings as $key => $booking)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->route_name }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->user_id }}</td>

                            <td>{{ $booking->total_seat }}</td>
                            <td>{{ $booking->seat_number }}</td>
                            
                            <td>{{ $booking->discount }}</td>
                            <td>{{ $booking->price }}</td>
                            <td>{{ $booking->pickup_location }}</td>
                            <td>{{ $booking->drop_location }}</td>
                           <td>
                                <!--<a class="btn btn-info" href="{{ route('route.show',$route->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('booking.edit',$booking->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['booking.destroy', $booking->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $bookings->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

@endsection

@section('ownjs')
    <script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this?");
        });
    </script>
@endsection