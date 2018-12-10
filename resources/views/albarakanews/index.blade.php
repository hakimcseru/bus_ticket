
@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>News list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('albarakanews.create') }}"> Create new News</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'albarakanews.index','method'=>'GET')) !!}
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Create Date</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($abnews as $key => $news)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $news->title }}</td>
                            <td>{{ $news->description }}</td>
                            <td>{{ $news->getstatus($news->status) }}</td>
                            <td>{{ $news->user->name }}</td>
                            <td>{{ $news->created_at }}</td>
                           <td>
                                <!--<a class="btn btn-info" href="{{ route('route.show',$news->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('albarakanews.edit',$news->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['albarakanews.destroy', $news->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $abnews->appends(Request::except('page'))->render() !!}
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