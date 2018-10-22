@extends('layouts.app')

@section('owncss')
    <link rel="stylesheet" href="{{asset('/tree/dist/jquery.tree-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create new role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <div class="form-line">
                   {!! Form::text('name', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Display Name:</strong>
                <div class="form-line">
                {!! Form::text('display_name', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <div class="form-line">
                {!! Form::textarea('description', null, array('placeholder' => '','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                <!--
                @foreach($permission as $value)
                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => "name filled-in chk-col-teal",'id'=>"md_checkbox$value->id")) }}

                    <label for="md_checkbox{{$value->id}}"> {{ $value->display_name }} </label>
                    <br/>
                @endforeach

                -->

                <select id="test-select" class="form-control" name="permission[]" multiple="multiple">
                    <?php
                    foreach ($children as $key=>$singlechildren){

                    foreach ($singlechildren as $des_singlechildren){
                    ?>
                    <option value='{{$des_singlechildren->id}}' data-section="{{$key}}" >{{$des_singlechildren->name}}</option>
                    <?php
                    }

                    }
                    ?>
                </select>



            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('ownjs')

    <script src="{{asset('/tree/lib/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/tree/src/jquery.tree-multiselect.js')}}"></script>

    <script type="text/javascript">
        $("#test-select").treeMultiselect({ enableSelectAll: true, sortable: false });
    </script>
@endsection