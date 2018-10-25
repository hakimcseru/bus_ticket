@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Price list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('price.create') }}"> Create new Price</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'price.index','method'=>'GET')) !!}
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
                        <th>route_name</th>
                        <th>vehicle_type</th>
                        <th>price</th>
                        <th>groups_per_person</th>
                        <th>group_members</th>
                      
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($prices as $key => $price)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $price->route_name }}</td>
                            <td>{{ $price->vehicle_type }}</td>
                            <td>{{ $price->price }}</td>
                            <td>{{ $price->groups_per_person }}</td>
                            <td>{{ $price->group_members }}</td>
                           
                           <td>
                                <!--<a class="btn btn-info" href="{{ route('price.show',$price->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('price.edit',$price->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['price.destroy', $price->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $prices->appends(Request::except('page'))->render() !!}
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