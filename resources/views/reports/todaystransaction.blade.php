@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/css/select2.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{asset('/tagged/css/taggle.css') }}">
    <style>
        .show_images img{
            width: 100%;
        }
    </style>
@endsection

@section('content')
Hi there
@endsection