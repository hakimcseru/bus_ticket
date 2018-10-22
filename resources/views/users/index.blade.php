@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Members list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create new member</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'users.index','method'=>'GET')) !!}
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
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Roles</th>
                        <th>Book Issues Expire Status</th>
                        <th>Address</th>
                        <th>Avatar</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($members as $key => $member)
                        <tr>
                            <td>{{ ++$i }}</td>
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
                            <td><?php

                                    $today = date('Y-m-d');

                                    $issueInfo = BookIssue::where('user_id',$member->id)->where('is_returned','0')->whereDate('end_date','<',$today)->first();
                                    if(count($issueInfo)>0){
                                ?>
                                <span style="background-color: red" class="badge badge-danger">Expired</span>

                                <?php } else { ?>

                                <span style="background-color: green" class="badge badge-danger">Not expired</span>

                                <?php }?>

                            </td>

                            <td>{{ $member->address }}</td>
                            <td><img src="{{Request::root()}}/uploads/profile/{{ $member->avatar }}" width="60" height="45"></td>




                            <td>
                                <a class="btn btn-info" href="{{ route('users.show',$member->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('users.edit',$member->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $member->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                    {!! $members->appends(Request::except('page'))->render() !!}
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