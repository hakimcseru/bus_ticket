@extends('frontend.app')

@section('owncss')

@endsection
<?php
use App\Category;
use App\BookIssue;
use App\Book;
?>
@section('content_search')
    <div class="search_section">

        {!! Form::open(array('route' => 'font_web.index','method'=>'GET')) !!}
        <div class="form-group">
            <label for="usr">Search the Book</label>
            {!! Form::text('search', null, array('placeholder' => 'Search for...','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="new_book">
                <!-- Set up your HTML -->
                <h2><span>New Books</span></h2>
                <div class="row">
                    @foreach ($books as $key => $book)
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="thumbnail">
                                <a href="{{ route('single.show',$book->id) }}">
                                    <?php
                                    if( $book->cover_photo == !null){  ?>
                                    <img style="max-height: 300px; min-height: 300px" src="{{Request::root()}}/uploads/books/{{ $book->cover_photo }}" alt="book">
                                    <?php } else { ?>
                                    <img src="{{Request::root()}}/images/book_av.png" alt="book">
                                    <?php }?>


                                    <div class="caption">
                                        <p>{{ $book->title }}</p>
                                        <h4><?php
                                            $category = json_decode($book->category);
                                            foreach ($category as $sub){
                                                $sInfo = Category::where('id',$sub)->first();
                                                echo '<span style="background-color: #ee4157;" class="badge badge-light">'. $sInfo->name.'</span>',' ';
                                            }
                                            ?></h4>
                                        <p>Author : {{ $book->author }}</p>
                                        <p>Publication Year : {{ $book->year_of_publication }}</p>

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
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {!! $books->appends(Request::except('page'))->render() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('ownjs')

@endsection
