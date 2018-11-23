@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/tinymce/parsley.css') }}" />
     <link rel="stylesheet" href="{{asset('/css/tagInput.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit new price</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('price.index') }}"> Back</a>
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
   
    {!! Form::model($price, ['method' => 'PATCH','route' => ['price.update', $price->id],'files' => true]) !!}

<div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">

                        

                <div class="row">


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>route_name :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::select('route_id', $route_ides, [], array('required' => 'required','class' => 'form-control multi-select')) !!}

                                </div>
                            </div>
                        </div>
                   
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>vehicle_type :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::select('vehicle_type', ['ac'=>'AC','non-ac'=>'Non AC'], ['ac'=>'AC'], array('class' => 'form-control show-tick')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>price :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('price', null, array('placeholder' => 'price', 'required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>groups_per_person :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('groups_per_person', null, array('placeholder' => 'groups_per_person', 'required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>group_members :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('group_members', null, array('placeholder' => 'group_members', 'required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                       


                      

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Status <span style="color: red">*</span> :</strong>
                                <div class="demo-radio-button">
                                    <input name="status" type="radio" id="radio_1" value="1" checked="">
                                    <label for="radio_1">Active</label>
                                    <input name="status" type="radio" id="radio_2" value="0" >
                                    <label for="radio_2">Inactive</label>
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

    -------------------
    <?php /*
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">

                

                <div class="row">


                        
                   
                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Name :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('name', $route->name, array('placeholder' => 'Name', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>start_point :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     {!! Form::select('start_point', $locations, $route->start_point, array('required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>end_point :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    
                                      {!! Form::select('end_point', $locations, $route->end_point, array('required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>stoppage_points :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <div class="form-control tags" id="tags">
                                          <input type="text" class="labelinput">
                                          <?php 
                                              $values=json_decode($route->stoppage_points);
                                          ?>
                                          <input type="hidden" value="{{  implode(",", $values)  }}" name="stoppage_points">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>distance :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('distance', null, array('placeholder' => 'distance', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>approximate_time :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('approximate_time', null, array('placeholder' => 'approximate_time', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>


                      

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Status <span style="color: red">*</span> :</strong>
                                <div class="demo-radio-button">
                                    <input name="status" type="radio" id="radio_1" value="1" checked="">
                                    <label for="radio_1">Active</label>
                                    <input name="status" type="radio" id="radio_2" value="0" >
                                    <label for="radio_2">Inactive</label>
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
    */?>
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


   <script src="{{asset('/js/tagInput.js') }}"></script>
    <script>
        $(function(){

          $('#tags').tagInput();

        });
    </script>

@endsection
