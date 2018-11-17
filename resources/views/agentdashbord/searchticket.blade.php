@extends('agentdashbord.app')
@section('owncss')

<style>
.total_seat{
    position: relative;
}
.total_seat span{}
.total_seat span ul{
    margin: 0;
    padding: 0;
    list-style: none;
    text-align: center;
}
.total_seat span ul li{
  display: inline-block;
  padding: 5px;
 }

.total_seat span ul li:nth-child(1n) {

}
.total_seat span ul :nth-child(2n) {
li
}

.total_seat span ul li:nth-child(3n) {
   padding-left: 60px;
}
.total_seat span ul li:nth-child(4n) {

}

.listiteam35{

}
.listiteam40{
    position: absolute;
    bottom: 0;
    left: 45%;
  
}
.booked_seat div{
    background-color:#96BDFA ;
}

.total_seat span ul li input[type="checkbox"]{}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    /* border-top: 1px solid #ddd; */
    border: 1px solid #ddd;
}

.table td:nth-child(2){

}

                                   
                                    .journey_total h4, .fare_total h4{

                                        color: #fff;
                                        background: #079d49;
                                        padding: 5px;
                                        margin-bottom: 0px;
                                    }
  
                                    .journal_details{
                                       background: #fafafa;
                                       border: 1px solid #079d49;
                                       padding: 5px;
                                    }
                                    .journal_details h5{border-bottom: 1px solid #ddd;}

                                    .fare_details{
                                      background: #fafafa;
                                      border: 1px solid #079d49;
                                      padding: 5px;
                                    }
                                    .fare_details h5{border-bottom: 1px solid #ddd;}
                                    .fare_details ul{margin:0;padding:0;list-style: none}
                                    .fare_details ul li{}
                                    .fare_details ul li span{float: right;}

                                    .custom_payment_area_total{}
                                    .custom_payment_area_total #paydetails{
                                      background: #079d49;
                                      color: #fff;
                                      padding: 5px;
                                      margin-bottom: 0;
                                      display: block;
                                    }
                                    .custom_payment_area h4 {
                                             padding: 20px 0;
                                    }
                                    .custom_payment_area #total_amount_payable{
                                       color: #079d49;
                                    }


                                    .custom_payment_area{
                                      border: 1px solid #079d49;
                                      text-align: center;
                                    }
                                    .custom_payment_area h3{}
                                  
                                    .custom_payment_area .nav-tabs{}
                                    .custom_payment_area .nav-tabs li{
                                      display: inline-block;
                                      float: none !important;
                                    }
                                    .custom_payment_area .nav-tabs li a{}
                                    .custom_payment_area .tab-content{}
                                    .custom_payment_area .tab-content div{}

                                    .passenger_details_total{}
                                    .passenger_details_total h4{color:#079d49;}
                                    .passenger_details{}

                                    #seat_plan_number .booked_seat .checker{
                                      background-position: right center;
                                    }

                                    .pasenger_information .form-float{
                                         overflow: hidden;
                                    }
                                    .floatleftcon{float: left;}
                                    .floatrightcon{
                                      float: right;
                                      padding-top: 24px;
                                      padding-left: 20px;
                                    }

                                .tdata{
                                    display:none;
                                }  
                                .clientonfo{
                                    background-color:#000;
                                    width:100%

                                }
                                .clientonfo td{
                                      padding:5px 20px 5px 5px; 
                                      background-color:#fff;
                                      border:1px solid #ccc;
                                }   
                                .clientonfo th{
                                    text-align:center;
                                    background-color:#fff;
                                      border:1px solid #ccc;
                                }  
                                




</style>
@endsection

@section('content')
<?php

use App\Price;
use App\Booking;

?>
 <div class="row m-4">
 <div class="container">
 @if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	@if(session('error-message'))
	<div class='alert alert-warning'>
		{{ session('error-message') }}
	</div>
	@endif
            <div class="col-xs-12 col-sm-12 col-md-12" style="overflow: scroll !important">
                 @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h3 style="margin-bottom: 2px;">Available Buses </h3><hr style="border-top: 3px solid #e24648;margin-top: 5px;">
                <table class="table table-hover table-responsive">
                    <tr>
                        <th>Boarding Time & Date</th>
                        <th>Coach No</th>
                        <th>Start Counter</th>
                        <th>End Counter</th>
                        <th>Fare</th>
                       <th>Sold</th>
                       <th>Book</th>
                       <th>Available</th>
                        
                        <th>Action</th>
                    </tr>
                    @foreach ($availablebus as $key => $available_single_bus)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $available_single_bus->fleet_registration_no }}</td>
                            
                            <td>{{ $available_single_bus->route_name }}</td>
                            <td>{{ $available_single_bus->start_point_name }}</td>
                            <td>{{ $available_single_bus->end_point_name }}</td>
                            
                            <td>{{ $available_single_bus->start_time }}</td>
                            <td>{{ $available_single_bus->end_time }}</td>

                            <td>{{ Price::where('route_id',$available_single_bus->route_id)->first()->price }}</td>
                           
                            <td>
                               

                              
                                <input placeholder="start_date_resarve2" id="start_date_resarve2" class="form-control" value="<?php if($start_date_resarve!=null){echo $start_date_resarve; } ?>" name="start_date_resarve2" type="hidden">

                               
                                <button type="button" id="{{ $available_single_bus->id }}" data-date="<?php if($start_date_resarve!=null){echo $start_date_resarve; } ?>" class="booking btn btn-primary">booking</button>


                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" id="tdata-{{ $available_single_bus->id }}" class="tdata">
                             <div class="row" style="padding:10px">
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
                                    <div class="col-xs-5 col-sm-5 col-md-5" style="background-color:white;border:1px solid #ccc;">
                                        
                                            <table class="clientonfo" cellspacing="1">
                                                <tr>
                                                  <th colspan='2'>Sold</th>
                                                  <th colspan='2'>Booked</th>
                                                  <th colspan='2'>Available</th>
                                                  <th colspan='2'>Block</th>
                                                </tr>
                                                <tr>
                                                    <th style="background-color:red;">M</th>
                                                    <th style="background-color:#F934DE;">F</th>
                                                    <th  style="background-color:#96BDFA  ;">M</th>
                                                    <th  style="background-color:#BCF9F5  ;">F</th>
                                                    <th colspan='2'>M</th>
                                                    <th colspan='2' style="background-color:#AEAEAE;">F</th>
                                                </tr>
                                                <tr>
                                                  <th colspan='2'>0</th>
                                                  <th colspan='2'></th>
                                                  <th colspan='2'></th>
                                                  <th colspan='2'></th>
                                                </tr>
                                            </table>
                                          
                                        <div id="seatplan-{{ $available_single_bus->id }}">
                                        </div>
                                        
                                    </div>  
                                    <div class="col-xs-7 col-sm-7 col-md-7" id="bookingdata-item">  
                                   {!! Form::open(array('route' => 'bookingdata.agentbooking','method'=>'POST', 'files' => true, 'runat'=>'server')) !!}
    
                                       <input type="hidden" name='assign_id'  value="{{ $available_single_bus->id }}" />
                                        <input type="hidden" name='booking_date' id='booking_date' value="<?=$_GET['start_date'];?>" />
                                        <input type="hidden" name='total_seat'  value="" class="total_seat" />
                                        <input type="hidden" name='seat_number'  value="" class="seat_number" />
                                        <input type="hidden" name='price'  value="" class="price" />
                                        
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">

                                                <table class="table">
                                                    <tbody>
                                                      <tr>
                                                        <td width="25%">Seat No</td>
                                                        <td width="25%">Ticket No</td>
                                                        <td width="25%">Fare</td>
                                                        <td width="25%">Discount</td>
                                                      </tr>
                                                      <tr>
                                                      <td><div id="show_selected_seat-{{ $available_single_bus->id }}"></div>  </td>
                                                        <td></rd>
                                                        <td><div id="show_price-{{ $available_single_bus->id }}"></div></td>
                                                        <td><div id="show_discount-{{ $available_single_bus->id }}"></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td >Total</td>
                                                        <td colspan="3"><div id="show_total_price-{{ $available_single_bus->id }}"></div></td>
                                                       
                                                      </tr>
                                                      <tr>
                                                        
                                                      </tr>
                                                      <tr>
                                                        <td >Grand Total</td>
                                                        <td  colspan="3"><div id="grand_total_price-{{ $available_single_bus->id }}"></div></td>
                                                        
                                                      </tr>
                                                    </tbody>
                                                  </table>


                                                
                                            </div>
                                        </div>
                                         <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table class="clientonfo" cellspacing="1">
                                                <tr>
                                                  <td width="25%">Passanger Name: </td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_name', null, array( 'required' => 'required','class' => 'form-control')) !!}
                                                  </td>
                                                  <td  width="25%" style="text-align:right">Mobile no:</td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_mobile', null, array( 'required' => 'required','class' => 'form-control')) !!}
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td width="25%">Gender: </td>
                                                  <td  width="25%">
                                                  {!! Form::select('passenger_gender', array('Male'=>'Male','Female'=>'Female'),'Male' ,array( 'required' => 'required','class' => 'form-control')) !!}
                                                  </td>
                                                  <td  width="25%" style="text-align:right">Age:</td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_age', null, array( 'required' => 'required','class' => 'form-control')) !!}
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td width="25%">Passport No: </td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_passport', null, array( 'class' => 'form-control')) !!}
                                                  
                                                  </td>
                                                  <td  width="25%" style="text-align:right">Nationality:</td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_nationality', null, array( 'class' => 'form-control')) !!}

                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td width="25%">Boarding place: </td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_boarding_place', null, array('class' => 'form-control')) !!}
                                                  </td>
                                                  <td  width="25%" style="text-align:right">Email:</td>
                                                  <td  width="25%">
                                                  {!! Form::text('passenger_email', null, array('class' => 'form-control')) !!}
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td width="25%">Boarding point: </td>
                                                  <td  width="25%">{!! Form::select('pickup_location', [], null, array('required' => 'required','class' => 'form-control')) !!}</td>
                                                  <td  width="25%" style="text-align:right">Dropping point:</td>
                                                  <td  width="25%">{!! Form::select('drop_location', [], null, array('required' => 'required','class' => 'form-control')) !!}</td>
                                                </tr>
                                                <tr>
                                                  <td width="25%">Total Paid: </td>
                                                  <td  width="25%">
                                                  {!! Form::text('total_paid', null, array('class' => 'form-control')) !!}
                                                  </td>
                                                  <td  width="25%" style="text-align:right">Total Refund:</td>
                                                  <td  width="25%">
                                                  {!! Form::text('total_refund', null, array('class' => 'form-control')) !!}
                                                  </td>
                                                </tr>
                                               
                                            </table>
                                         </div>
                                         <input placeholder="start_date_resarve" id="start_date_resarve" class="form-control" value="<?php if($start_date_resarve!=null){echo $start_date_resarve; } ?>" name="start_date_resarve" type="hidden">
                                         <div id="hidden_selected_seat"></div>  
                                        <div id="hidden_selected_assign"></div>  
                                        <div id="grand_total_price2"></div>  
                                        <div id="total_seat_reserve"></div>
                                       
                                    <div class="row" style="padding-top:20px;">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-success " style="width:100%">Continue</button>
                                        </div>
                                         <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-success " style="width:100%">Reset</button>
                                        </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>  
                                </div> 
                            </td>
                        </tr>
                    @endforeach
                </table>



               
            </div>       
        </div>
/div>
        @endsection

@section('ownjs')
 <script>
    $(document).ready(function(){
        $('.booking').click(function(){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

        var selected = [];
        var show_selected = [];
        var discount =0;
        var grand_total_price =0;
        var assign_id=$(this).attr('id');
        var data_date=$(this).attr('data-date');

        //$('#myModal').modal('show');  
        $(".tdata").hide();
        $("#tdata-"+assign_id).show();
        $.ajax({
                url: '{{Request::root()}}/bookingfront/'+assign_id+'/'+data_date,
                type: "GET",
                dataType: "json",
                success:function(data) {
                console.log(data);
                $("#hidden_selected_assign").html('<input type="hidden" class="check" name="hidden_selected_assign" value="'+data.assign.id+'">');
                    var count=0; 
                    var str = '<div class="total_seat">'
                    $.each(data.seat_number, function(index,item){
                              
                    count=count+1; 
                    if(index==0){
                        str += '<span class="listiteam'+index+'"><ul>'
                        }
                               
                    if($.inArray(item, data.bookingcheck) !== -1){
                        str += '<li class="listiteam'+index+' booked_seat"><div  style="position:relative;"><input disabled readonly type="checkbox" id="'+item+'" class="check trigger" name="select_seat_number" value="'+item+'"> <label for="'+item+'" class="checker"><span class="pob" style="    position: absolute;\n' +
                                '    left: 30%;\n' +
                                '    top: 20%;">'+item+'</span></label></div></li>';
                    }else{
                        str += '<li class="listiteam'+index+'"><div  style="position:relative;"><input type="checkbox" id="'+item+'" class="check trigger" name="select_seat_number" value="'+item+'"> <label for="'+item+'" class="checker"><span class="pob" style="    position: absolute;\n' +
                                '    left: 30%;\n' +
                                '    top: 20%;">'+item+'</span></label></div></li>';
                        }


                    if(index!=0 && count%4==0){
                        str += '</ul></span><span class="listiteam'+index+'"><ul>'
                        }

                    });
                    str += '<ul></span></div>';
                    //document.getElementById("seat_plan_number").innerHTML = str;
                    document.getElementById("seatplan-"+assign_id).innerHTML = str;

                    

                var click =0;
                $(".pob").click(function () {
                click = click+1;
                if (click % 2 == 0) {
                    console.log('even')
                    $(this).css("color","#000");
                    }
                else {
                    console.log('odd')
                    $(this).css("color","#CCC");
                    }
                    console.log(click)
                });
            $(".checker").click(function () {
                click = click+1;
                if (click % 2 == 0) {
                    console.log('even')
                    $(this).css("color","#000");
                    }
                else {
                    console.log('odd')
                    $(this).css("color","#ccc");
                  }
                 console.log(click)
              });

             $.each(data.stoppes_pointes, function(index,item){
             $('select[name="pickup_location"]').append('<option value="'+ item +'">'+ item +'</option>');
             $('select[name="drop_location"]').append('<option value="'+ item +'">'+ item +'</option>');
             });

    
                            $("input[type=checkbox]").click(function () {

                                $("#count").html($("input[type=checkbox]:checked").length);

                                if($(this).is(':checked')){
                                     show_selected.push($(this).val());
                                }else{
                                     show_selected.splice($.inArray($(this).val(), selected),1);
                                }  

                                 $("#hidden_selected_seat").html('<input type="hidden" class="check" name="order_seat" value="'+show_selected.join(",")+'" required>');

                                 $("#show_selected_seat-"+assign_id).html(show_selected.join(", "));

                                 $(".total_seat").val(show_selected.length);
                                 $(".seat_number").val(show_selected.join(", "));
                                
                                 $("#show_price-"+assign_id).html(data.price_info.price*$("input[type=checkbox]:checked").length);
                                 $("#show_total_price-"+assign_id).html(data.price_info.price*$("input[type=checkbox]:checked").length);
                                 $("#show_discount-"+assign_id).html(discount);
                                 grand_total_price=((100-discount)*(data.price_info.price*$("input[type=checkbox]:checked").length))/100
                                 $("#grand_total_price-"+assign_id).html(grand_total_price);
                                 $(".price").val(grand_total_price);


                                 $("#grand_total_price2").html('<input type="hidden" class="check" name="grand_total_price" value="'+grand_total_price+'">');
                                 $("#total_seat_reserve").html('<input type="hidden" class="check" name="total_seat_reserve" value="'+$("input[type=checkbox]:checked").length+'">');

                            });
                            
                    }
                });

                $('select[name="pickup_location"]').empty();
                $('select[name="drop_location"]').empty();
                $("#count").empty();
        });
    });


//next booking

   $(document).ready(function(){
        $('.bookingnext').click(function(e){
                e.preventDefault();
               

                var form_action = $("#bookingdata-item").find("form").attr("action");
                var pickup_location = $("#bookingdata-item").find("select[name='pickup_location']").val();
                var drop_location = $("#bookingdata-item").find("select[name='drop_location']").val();
                var order_seat = $("#bookingdata-item").find("input[name='order_seat']").val();
                var grand_total_price = $("#bookingdata-item").find("input[name='grand_total_price']").val();
                var hidden_selected_assign = $("#bookingdata-item").find("input[name='hidden_selected_assign']").val();
                var start_date_resarve = $("#bookingdata-item").find("input[name='start_date_resarve']").val();
                var total_seat_reserve = $("#bookingdata-item").find("input[name='total_seat_reserve']").val();

               

               if(order_seat==undefined || grand_total_price==0){
                     alert("Please select Seat");
                     $('#myModal').modal('show');  
               }else{

                 $('#myModal').modal('hide');  
                 $('#myModalnext').modal('show');  

                 $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                 });

                 $.ajax({
                    url: '{{Request::root()}}/bookingdata/reserve',
                    type: "POST",
                    dataType: "json",
                    data:{pickup_location:pickup_location, drop_location:drop_location, order_seat:order_seat,grand_total_price:grand_total_price,hidden_selected_assign:hidden_selected_assign,start_date_resarve:start_date_resarve,total_seat_reserve:total_seat_reserve},
                    success:function(data) {
                           console.log(data); 

                            
                            $("#total_amount_payable").html(data.grand_total_price);
                            $("#total_with_bank_free").html(data.grand_total_price);
                            $("#total_amount_payable_hidden").html('<input type="hidden" class="check" name="total_amount_payable_hidden" value="'+data.grand_total_price+'">');
                            $("#grand_total_price_final").html(data.grand_total_price);
                            $("#show_selected_seat_final").html(data.order_seat);
                            $("#order_id_final").html('<input type="hidden" class="check" name="order_id_final" value="'+data.order_id+'">');

                            var str2 = '<div class="pasenger_information">'
                            for (var i=0; i<data.total_seat_reserve; i++) {
                              
                                str2 += '<div class="form-group form-float"><div class="floatleftcon"><strong>Passenger Name '+i+':</strong><div class="input-group"><span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span><input placeholder="Name" required="required" class="form-control" name="name'+i+'" type="text"></div></div><div class="floatrightcon"><div class="demo-radio-button"><input name="status" type="radio" id="radio_1" value="1" checked=""><label for="radio_1">Male</label><input name="status" type="radio" id="radio_2" value="0" ><label for="radio_2">Female</label></div></div></div>';
                            };
                            str2 += '</div>';

                            document.getElementById("pas_details_place").innerHTML = str2;
                    }
                 });

               }

               

                
        });
    });

</script>

@endsection