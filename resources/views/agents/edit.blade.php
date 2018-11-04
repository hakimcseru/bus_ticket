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
                <h2>Agent Buy ticket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('agents.index') }}"> Back</a>
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



{!! Form::model($member, ['method' => 'PATCH','route' => ['agents.update', $member->id],'files' => true]) !!}
    <div class="row">

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group form-float">
                                <strong>Agent Name :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {!! Form::text('name', $member->name, array('placeholder' => 'Name', 'required' => 'required','class' => 'form-control','readonly'=>'readonly')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group form-float">
                                <strong>Agent contact number :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {!! Form::text('contact_number', $member->contact_number, array('placeholder' => 'Name', 'required' => 'required','class' => 'form-control','readonly'=>'readonly')) !!}
                                </div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Select Route <span style="color: red">*</span> :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                   

                                   {!! Form::select('route_id[]', $routes,[], array('required' => 'required','class' => 'form-control multi-select')) !!}



                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Per ticket Discount <span style="color: red">*</span>:</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    {!! Form::number('per_ticket_discount', null, array('placeholder' => 'Per ticket Discount', 'required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Amount <span style="color: red">*</span> :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    {!! Form::number('amount', null, array('placeholder' => 'Amout', 'required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>date_of_bill <span style="color: red">*</span> :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    {!! Form::text('date_of_bill', null, array('placeholder' => 'date_of_bill', 'required' => 'required','class' => 'form-control','id'=>'start_date')) !!}

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



         
    </div>

{!! Form::close() !!}



@endsection

@section('ownjs')
    <script src="{{asset('/date/jquery.datetimepicker.full.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( "#datetimepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datetimepicker_join" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datetimepicker_confirmation" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datetimepicker_termination" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
    </script>


    <script src="{{asset('/tinymce/parsley.min.js') }}"></script>
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#notetextarea',
            plugin: 'link code',
            menubar: false
        });

        tinymce.init({
            selector: '#addresstextarea',
            plugin: 'link code',
            menubar: false
        });
    </script>

@endsection