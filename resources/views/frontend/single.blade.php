@extends('frontend.app')

@section('owncss')

@endsection

@section('content_search')
    <div class="search_replace_for_contact">

    </div>
@endsection
<?php
use App\Category;
use App\BookIssue;
use App\Book;
?>
@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="single_book_title">
                <h3>{{ $book->title }}</h3>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="thumbnail">

                <?php
                if( $book->cover_photo == !null){  ?>
                <img style="max-height: 300px; min-height: 300px" src="{{Request::root()}}/uploads/books/{{ $book->cover_photo }}" alt="book">
                <?php } else { ?>
                <img src="{{Request::root()}}/images/book_av.png" alt="book">
                <?php }?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="add_to_card_section">
                <div class="details">
                    <p>{{ $book->title }}</p>
                    <h4>Category : <?php
                        $category = json_decode($book->category);
                        foreach ($category as $sub){
                            $sInfo = Category::where('id',$sub)->first();
                            echo '<span style="background-color: #ee4157;" class="badge badge-light">'. $sInfo->name.'</span>',' ';
                        }
                        ?></h4>
                    <?php
                    if($book->taggles != null){
                    ?>
                    <h5>Tag : <?php
                        $taggles = json_decode($book->taggles);
                        foreach ($taggles as $tag){
                            echo '<span style="background-color: #999999;" class="badge badge-light">'. $tag.'</span>',' ';
                        }
                        ?></h5>
                    <?php }?>

                    <p>Author : {{ $book->author }}</p>
                    <p>Publication Year : {{ $book->year_of_publication }}</p>
                </div>

                <?php

                $bookIssueInfo = BookIssue::where('is_returned',0)->get();

                $issueCopy = [];

                foreach ($bookIssueInfo as $issueIn){
                    $issueCopy[] = $issueIn->copy_number;
                }

                $qr_string = json_decode($book->qr_string);

                $is_available = 0;
                foreach ($qr_string as $qr_s){
                    if (!in_array($qr_s, $issueCopy)) {

                        $is_available = 1;
                    }
                }


                ?>

                <form action="{{ url('/print') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $book->id }}">
                    <input type="hidden" name="title" value="{{ $book->title }}">
                    <input type="hidden" name="author" value="{{ $book->author }}">
                    <?php
                        if($is_available == 1){
                    ?>
                    <input type="submit" class="btn btn-success btn-sm" value="Add to Wishlist">
                    <?php } else {?>
                    <input type="button" class="btn btn-warning btn-sm" value="Already Issued">
                    <?php }?>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('ownjs')

@endsection
