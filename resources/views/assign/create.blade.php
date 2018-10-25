@extends('layouts.app')
@section('owncss')

    <link rel="stylesheet" href="{{asset('/css/select2.min.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create new Assign</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('assign.index') }}"> Back</a>
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
    {!! Form::open(array('route' => 'assign.store','method'=>'POST', 'files' => true, 'runat'=>'server')) !!}

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">

                        

                <div class="row">


                        
                   
                        

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>fleet_registration_no :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               

                                     {!! Form::select('fleet_registration_no', $fleet_registration_noes, [], array('required' => 'required','class' => 'form-control multi-select')) !!}

                                </div>
                            </div>
                        </div>

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
                                <strong>start_date :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('start_date', null, array('placeholder' => 'start_date', 'id'=>'start_date', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>end_date :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('end_date', null, array('placeholder' => 'end_date', 'id'=>'return_date', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>



                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>driver_name :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     
                                     {!! Form::select('driver_name', $drivers, [], array('required' => 'required','class' => 'form-control multi-select')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>assistants :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     
                                     {!! Form::select('assistants[]', $assistants, [], array('required' => 'required','class' => 'form-control multi-select','multiple'=>'multiple')) !!}

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
    {!! Form::close() !!}
@endsection



@section('ownjs')

   <script src="{{asset('/js/select22.min.js')}}"></script>
   <script type="text/javascript">
      $(".multi-select").select2();
   </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#return_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      } );
    </script>

@endsection