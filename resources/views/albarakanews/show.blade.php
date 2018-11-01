@extends('layouts.app')
<?php
use App\BookIssue;

?>
@section('content')

    <?php
    $today = date('Y-m-d');

    $issueInfo = BookIssue::where('user_id',$member->id)->where('is_returned','0')->orderBy('id','DESC')->first();

    ?>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Member Profile Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-thumbnail" src="{{Request::root()}}/uploads/profile/{{ $member->avatar }}" width="350">
                    </a>
                </div>
                <div class="media-body">
                    <dl class="dl-horizontal">

                        <dt>Name : </dt>
                        <dd>{{ $member->name }}</dd>


                        <dt>Email : </dt>
                        <dd>{{ $member->email }}</dd>

                        <dt>Contact number : </dt>
                        <dd>{{ $member->contact_number }}</dd>

                        <dt>Address : </dt>
                        <dd>{{ $member->address }}</dd>

                    </dl>
                    <div class="media-body">
                        <dl class="dl-horizontal">
                        <?php
                        if(count($issueInfo)>0){
                        ?>

                                    <h5>History of book issues .</h5></br>
                            <dt>status : </dt>
                            <dd><?php
                            if($today > $issueInfo->end_date){
                                echo '<span style="background-color: red" class="badge badge-danger">Expire</span>';
                            } else {

                                echo '<span style="background-color: green" class="badge badge-danger">Not expire</span>';
                            }

                        ?></dd>
                        <dt>Book title </dt>
                        <dd>{{ $issueInfo->book_title }}</dd>

                            <dt>Issue Date </dt>
                            <dd>{{ $issueInfo->start_date }}</dd>

                            <dt>Return date </dt>
                            <dd>{{ $issueInfo->end_date }}</dd>


                        <?php }?>
                        </dl>

                    </div>
                </div>

            </div>








        </div>
    </div>
@endsection