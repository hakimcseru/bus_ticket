@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Bus list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bus.create') }}"> Create new bus</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'bus.index','method'=>'GET')) !!}
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
                        <th>registration_no</th>
                        <th>fleet_type</th>
                        <th>engine_no</th>
                        <th>model_no</th>
                        <th>total_seat</th>
                        <th>seat_number</th>
                        <th>bus_photo</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($buses as $key => $bus)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $bus->registration_no }}</td>
                            <td>{{ $bus->fleet_type }}</td>
                            <td>{{ $bus->engine_no }}</td>
                            <td>{{ $bus->model_no }}</td>
                            <td>{{ $bus->total_seat }}</td>
                            <td>{{ $bus->seat_number }}</td>
                            <td><img src="{{Request::root()}}/uploads/bus/{{ $bus->bus_photo }}" width="60" height="45"></td>
                            <td>
                                <!--<a class="btn btn-info" href="{{ route('bus.show',$bus->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('bus.edit',$bus->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['bus.destroy', $bus->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $buses->appends(Request::except('page'))->render() !!}
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