@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Route list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('route.create') }}"> Create new Route</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'route.index','method'=>'GET')) !!}
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
                        <th>start_point</th>
                        <th>end_point</th>
                        <th>stoppage_points</th>
                        <th>distance</th>
                        <th>approximate_time</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($routes as $key => $route)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $route->name }}</td>
                            <td>{{ $route->start_point }}</td>
                            <td>{{ $route->end_point }}</td>
                            <td>{{ $route->stoppage_points }}</td>
                            <td>{{ $route->distance }}</td>
                            <td>{{ $route->approximate_time }}</td>
                           <td>
                                <!--<a class="btn btn-info" href="{{ route('route.show',$route->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('route.edit',$route->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['route.destroy', $route->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $routes->appends(Request::except('page'))->render() !!}
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