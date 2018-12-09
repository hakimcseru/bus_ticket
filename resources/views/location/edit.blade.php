@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/tinymce/parsley.css') }}" />

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create new location</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('location.index') }}"> Back</a>
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
   
    {!! Form::model($location, ['method' => 'PATCH','route' => ['location.update', $location->id],'files' => true]) !!}

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">

                

                <div class="row">
                   
                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Name :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('name', $location->name, array('placeholder' => 'Name', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Location Description :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    {!! Form::textarea('description', $location->description, array('placeholder' => 'description','class' => 'form-control','rows'=>3)) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Status <span style="color: red">*</span> :</strong>
                                <div class="demo-radio-button">
                                    <input name="status" type="radio" id="radio_1" value="1" <?php if($location->status==1) echo 'checked="checked"';?>>
                                    <label for="radio_1">Active</label>
                                    <input name="status" type="radio" id="radio_2" value="0" <?php if($location->status==0) echo 'checked="checked"';?> >
                                    <label for="radio_2">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <div class="form-group form-float">
                                        <strong>Location Image :</strong>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                            {!! Form::file('location_photo', array('class'=>'form-control','id'=>'imgInp')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group form-float">
                                        <?php
                                         if($location->location_photo!=''){?>
                                            <img id="blah" style="width:150px;" src="{{Request::root()}}/uploads/location/{{ $location->location_photo }}" alt="your image" />
                                        <?php }else{?>
                                            <img id="blah" style="width:150px;" src="{{Request::root()}}/images/preview_file.png" alt="your image" />
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </div>
            </div>
        </div>
        
    </div>
    {!! Form::close() !!}
@endsection



@section('ownjs')

  <script>

    function readURL(input) {

        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
     });

  </script>

@endsection
