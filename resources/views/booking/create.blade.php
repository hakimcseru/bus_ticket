@extends('layouts.app')
@section('owncss')
    <link rel="stylesheet" href="{{asset('/date/jquery.datetimepicker.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/tinymce/parsley.css') }}" />
    <link rel="stylesheet" href="{{asset('/css/tagInput.css') }}" />

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create new Booking</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('booking.index') }}"> Back</a>
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
    {!! Form::open(array('route' => 'booking.store','method'=>'POST', 'files' => true, 'runat'=>'server')) !!}

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="employee_basic_info">

                        

                <div class="row">


                        
                   
                       
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>Booking Route :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     {!! Form::select('route_id', $route_ides, [], array('required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>booking_date :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                     {!! Form::text('booking_date', null, array('placeholder' => 'booking_date', 'id'=>'start_date', 'required' => 'required','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>pickup_location :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     {!! Form::select('pickup_location', [], null, array('required' => 'required','class' => 'form-control')) !!}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <strong>drop_location :</strong>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                               
                                     {!! Form::select('drop_location', [], null, array('required' => 'required','class' => 'form-control')) !!}

                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group form-float">
                                <div class="input-group" id="bookingid">
                                
                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                  </div>
                                  <div class="modal-body">
                                         <div id="seat_plan_number">
                                         </div>   
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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


   <script src="{{asset('/js/tagInput.js') }}"></script>
    <script>
        $(function(){

          $('#tags').tagInput();

        });
    </script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
       
      } );
    </script>



    <script type="text/javascript">

        $('select[name="route_id"]').on('change', function() {
           var stateId = $(this).val();
          
          

           

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(stateId) {
                $.ajax({
                    url: '{{Request::root()}}/dashboard/chancestopes/stopes/'+stateId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                       
                        $("#bookingid").append('<button type="button" id="booking"  data-id="'+stateId+'" class="btn btn-primary">book</button>');
                        console.log(data);

                        $.each(data, function(index, item) {
                            //now you can access properties using dot notation
                             //console.log(index);
                            $('select[name="pickup_location"]').append('<option value="'+ item +'">'+ item +'</option>');
                            $('select[name="drop_location"]').append('<option value="'+ item +'">'+ item +'</option>');
                        });
                        //$('select[name="copy_number"]').append('<option value="'+ data.cities.user_id +'">'+ data.cities.user_name +'</option>');

                    }
                });
                $('select[name="pickup_location"]').empty();
                $('select[name="drop_location"]').empty();
                $("#bookingid").empty();
            }else{
                $('select[name="pickup_location"]').empty();
                $('select[name="drop_location"]').empty();
                $("#bookingid").empty();
                
            }
        });
    </script>

   <script>
         $(document).on("click", "#booking" , function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var assign_id=$(this).attr("data-id");

                $('#myModal').modal('show');  

           
                $.ajax({
                    url: '{{Request::root()}}/dashboard/checkbookingseat/bookingseat/'+assign_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                            //console.log(data.seat_number);

                            var str = '<ul>'

                            $.each(data.seat_number, function(index,item){
                              str += '<li><input type="checkbox" class="check" name="select_seat_number[]" value="'+item+'">'+item+'</li>';
                            });

                            str += '</ul>';

                            document.getElementById("seat_plan_number").innerHTML = str;

                            $(document).on('change', '.check', function(event) { 
                                var val = $(this).val($(this).is(':checked'));
                                alert(val);
                            });

                            alert($(":checkbox:checked").length);
                                                     
                    }
                });
               
               
           
           
            
          
        });

   </script>



@endsection