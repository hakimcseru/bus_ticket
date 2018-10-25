@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Assign list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('assign.create') }}"> Create new Assign</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'assign.index','method'=>'GET')) !!}
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
                        <th>fleet_registration_no</th>
                        <th>route_name</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>driver_name</th>
                        <th>assistants</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($assignes as $key => $assign)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $assign->fleet_registration_no }}</td>
                            <td>{{ $assign->route_name }}</td>
                            <td>{{ $assign->start_date }}</td>
                            <td>{{ $assign->end_date }}</td>
                            <td>{{ $assign->driver_name }}</td>
                            <td>{{ $assign->assistants }}</td>
                           <td>
                                <!--<a class="btn btn-info" href="{{ route('assign.show',$assign->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('assign.edit',$assign->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['assign.destroy', $assign->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $assignes->appends(Request::except('page'))->render() !!}
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