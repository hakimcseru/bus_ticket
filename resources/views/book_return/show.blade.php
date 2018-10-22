@extends('layouts.app')
<?php
use App\Category;
use App\BookReturn;
use App\Book;
use App\BookIssue;

$bookIssueInfo = BookIssue::where('id',$item->book_issue_id)->first();
if(count($bookIssueInfo)>0){
    $bookInfo = Book::where('id',$bookIssueInfo->book_id)->first();
}


?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('book_return.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-thumbnail" src="{{Request::root()}}/uploads/books/{{ $bookInfo->cover_photo }}" width="350">
                    </a>
                </div>
                <div class="media-body">
                    <dl class="dl-horizontal">

                        <dt>Title : </dt>
                        <dd>{{ $bookInfo->title }}</dd>

                        <dt>Member Name : </dt>
                        <dd>{{ $bookIssueInfo->user_name }}</dd>

                        <dt>Copy Number : </dt>
                        <dd>{{ $bookIssueInfo->copy_number }}</dd>


                        <dt>Issue Date : </dt>
                        <dd>{{ $bookIssueInfo->start_date }}</dd>

                        <dt>Return Expire Date : </dt>
                        <dd>{{ $bookIssueInfo->end_date }}</dd>

                        <dt>Return Date : </dt>
                        <dd>{{ $item->return_date }}</dd>

                        <dt>Late Count : </dt>
                        <dd>{{ $item->late_count }}</dd>

                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection