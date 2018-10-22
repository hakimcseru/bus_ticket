@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Location list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('location.create') }}"> Create new Location</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'location.index','method'=>'GET')) !!}
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location Image</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($locations as $key => $location)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->description }}</td>
                            <td><img src="{{Request::root()}}/uploads/location/{{ $location->location_photo }}" width="60" height="45"></td>
                            <td>
                                <a class="btn btn-info" href="{{ route('location.show',$location->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('location.edit',$location->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['location.destroy', $location->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $locations->appends(Request::except('page'))->render() !!}
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