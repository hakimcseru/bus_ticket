@extends('layouts.app')

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
   padding-left: 65px;
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

                                        




</style>
@endsection

<?php

use App\Price;
use App\Booking;

?>
    @section('content')

        <div class="row m-4">
            <div class="col-xs-12 col-sm-12 col-md-12" style="overflow: scroll !important">
                 @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h3 style="margin-bottom: 2px;">Available Buses </h3><hr style="border-top: 3px solid #e24648;margin-top: 5px;">
                <table class="table table-hover table-responsive">
                    <tr>
                        <th>No</th>
                        <th>fleet_registration_no</th>
                       
                        <th>route_name</th>
                        <th>start_point_name</th>
                        <th>end_point_name</th>
                       
                        <th>start_time</th>
                        <th>end_time</th>

                        <th>Fare</th>

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
                    @endforeach
                </table>


                <!--modal-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Click on Seat to select / deselect</h4>
                          </div>
                          <div class="modal-body">

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div id="seat_plan_number">
                                        </div>
                                        
                                    </div>  
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="bookingdata-item">  
                                   {!! Form::open(array('route' => 'bookingdata.index','method'=>'POST', 'files' => true, 'runat'=>'server')) !!}
    
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">

                                                <table class="table">
                                                    <tbody>
                                                      <tr>
                                                        <td width="50%">Seat</td>
                                                        <td><div id="show_selected_seat"></div>  </td>
                                                      </tr>
                                                      <tr>
                                                        <td>Price</td>
                                                        <td><div id="show_price"></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Total</td>
                                                        <td><div id="show_total_price"></div></td>
                                                       
                                                      </tr>
                                                      <tr>
                                                        <td>Discount</td>
                                                        <td><div id="show_discount"></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Grand Total</td>
                                                        <td><div id="grand_total_price"></div></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>


                                                
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
                                                <strong>Offer Code :</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                               
                                                    {!! Form::text('offer_code', null, array('placeholder' => 'Offer code', 'id'=>'offer_code','class' => 'form-control')) !!}

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                              

                                              <input placeholder="start_date_resarve" id="start_date_resarve" class="form-control" value="<?php if($start_date_resarve!=null){echo $start_date_resarve; } ?>" name="start_date_resarve" type="hidden">
                                            </div>
                                        </div> 

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <div id="hidden_selected_seat"></div>  
                                                <div id="hidden_selected_assign"></div>  
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <div id="grand_total_price2"></div>  
                                                <div id="total_seat_reserve"></div>  
                                            </div>
                                        </div>

                                          
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-success bookingnext">Continue</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>  
                                </div>  
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           
                          </div>
                        </div>
                    </div>
                </div>


                <!--next modal open-->
                <!--next modal open-->
                <!--next modal open-->
                <!--modal-->
                <div class="modal fade" id="myModalnext" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Buy bus tickets</h4>
                          </div>
                          <div class="modal-body">
                              {!! Form::open(array('route' => 'pay.index','method'=>'GET', 'files' => true, 'runat'=>'server')) !!}
                                <div class="row">
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <div class="passenger_details_total"> 
                                          <h4>Passenger Details</h4>
                                          <div class="passenger_details"> 
                                              

                                            
                                               <div class="form-group form-float">
                                                  <div class="input-group" id="pas_details_place">
                                                  </div>
                                              </div>

                                             
                                           
                                            
                                              <div class="form-group form-float">
                                                  <strong>Email <span style="color: red">*</span> :</strong>
                                                  <div class="input-group">
                                                      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                                      {!! Form::text('email', null, array('placeholder' => 'Email', 'required' => 'required','class' => 'form-control')) !!}

                                                  </div>
                                              </div>
                                           
                                              <div class="form-group form-float">
                                                  <strong>Contact number <span style="color: red">*</span>:</strong>
                                                  <div class="input-group">
                                                      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                      {!! Form::text('contact_number', null, array('placeholder' => 'Contact number', 'required' => 'required','class' => 'form-control')) !!}

                                                  </div>
                                              </div>
                                              <div class="form-group form-float">
                                                  <div class="input-group" id="order_id_final">
                                                     
                                                  </div>
                                              </div>
                                            </div>  
                                         </div>  
                                    </div>  
                                  
                                    <div class="col-xs-4 col-sm-4 col-md-4">  
                                     
                                        
                                              <div class="journey_total">
                                                 <h4>Journey Details</h4>
                                                <div class="journal_details">
                                                   

                                                    <p id="show_selected_seat_final"></p>
                                                    <p id="start_date_resarve"></p>
                                                    <p id="drop_location_pickup_location"></p>
                                                </div>
                                              </div>
                                           
                                         
                                    </div> 
                                </div> 

                                <div class="row">   
                                    <div class="col-xs-8 col-sm-8 col-md-8"> 
                                      <div class="custom_payment_area_total">    
                                        <h4 id="paydetails">Payment Details</h4>
                                        <div class="custom_payment_area">
                                          <p id="total_amount_payable_hidden"></p>
                                           <h4>Total Amount Payable ৳.<span id="total_amount_payable"> 0</span></h4>
                                           <?php 
                                           if(isset(Auth::user()->id))
                                           {
                                            $nagent=AgentsBalance::where('agent_id',Auth::user()->id)->get();    
                                            if($nagent)
                                            {
                                                echo '<h4>Agent commission:'.$nagent->per_ticket_discount.'</h4>';
                                            }
                                           }
                                           else {?>
                                          <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#home">bKash</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Cash on Delivery</a></li>
                                            <li><a data-toggle="tab" href="#menu2">Credit or Debit Card</a></li>
                                            <li><a data-toggle="tab" href="#menu3">Internet Banking</a></li>
                                          </ul>
                                           <?php } ?>

                                          <div class="tab-content">
                                            <div id="home" class="tab-pane fade in active">
                                             
                                              <p>Your journey time is too close. Payment through bKash is not available. Try paying through Credit / Debit Cards or Internet banking.</p>
                                            </div>
                                            <div id="menu1" class="tab-pane fade">
                                             
                                              <p>Cash on Delivery is not available at this moment. Try paying through bKash, Credit / Debit Cards or Internet banking.</p>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                             
                                              <p>You would be redirected to a third party payment gateway where you can pay with your credit or debit cards. Your payment transactions are 100% secure. On successful payment, you would get a confirmed ticket.</p>
                                            </div>
                                            <div id="menu3" class="tab-pane fade">
                                             
                                              <p>You would be redirected to a third party payment gateway where you can pay with your internet banking accounts. Your payment transactions are 100% secure. On successful payment, you would get a confirmed ticket.</p>
                                            </div>
                                          </div>

                                        </div>
                                        </div>

                                   </div> 

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                          <div class="fare_total">
                                             <h4>Fare Details</h4>
                                             <div class="fare_details">
                                                       

                                                        <ul>
                                                          <li>Ticket Price <span id="grand_total_price_final" class="fare_right"></span></li>
                                                          <li>Albaraka Fee <span id="albaraka_free" class="fare_right">0</span></li>
                                                          <li>Bank Charges <span id="bankcharge" class="fare_right">0</span></li>
                                                          <li>Discount <span id="discount" class="fare_right">0</span></li>
                                                          <li>Total <span id="total_with_bank_free" class="fare_right">0</span></li>
                                                        </ul>
                                                    
                                               </div>
                                           </div>
                                     </div>  
                                  </div> 
                                  <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-success">Proceed To Order</button>
                                      </div>
                                  </div> 
                                {!! Form::close() !!} 
                          </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           
                          </div>
                        </div>
                    </div>
                </div>

                <!--next modal open-->
                <!--next modal open-->
                <!--next modal open-->

               
            </div>       
        </div>
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



                

                //alert(data_date);


                $('#myModal').modal('show');  

                $.ajax({
                    url: '{{Request::root()}}/bookingfront/'+assign_id+'/'+data_date,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                            console.log(data);

                            /*var str = '<ul>'
                            $.each(data.seat_number, function(index,item){
                               
                              str += '<li class="listiteam'+index+'"><input type="checkbox" class="check" name="select_seat_number" value="'+item+'">'+item+'</li>';
                               
                            });
                            str += '</ul>';
                            document.getElementById("seat_plan_number").innerHTML = str;*/

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
                            document.getElementById("seat_plan_number").innerHTML = str;

                       

                       
                        //$(".booked_seat").off('click');
                        //$( ".pop" ).unbind();
                        //$( ".checker" ).unbind();
                       


                      var click =0;
                        $(".pob").click(function () {
                            click = click+1;
                            // $(this).css("color","#fff");
                            if (click % 2 == 0) {
                                console.log('even')
                                $(this).css("color","#000");
                            }
                            else {

                                console.log('odd')
                                $(this).css("color","#fff");
                            }
                            console.log(click)
                        });
                        $(".checker").click(function () {
                            click = click+1;
                            // $(this).css("color","#fff");
                            if (click % 2 == 0) {
                                console.log('even')
                                $(this).css("color","#000");
                            }
                            else {

                                console.log('odd')
                                $(this).css("color","#fff");
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


                               /* if($(this).is(':checked')){
                                     selected.push('<input type="hidden" class="check" name="order_seat" value="'+$(this).val()+'">');
                                }else{
                                     selected.splice($.inArray('<input type="hidden" class="check" name="order_seat" value="'+$(this).val()+'">', selected),1);
                                } */



                                //console.log(selected);  
                                // alert("My favourite sports are: " + selected.join(", "));
                                //document.getElementById("seat_plan_number").innerHTML = selected.join(", ");
                                 //$("#hidden_selected_seat").html(selected);
                                 $("#hidden_selected_seat").html('<input type="hidden" class="check" name="order_seat" value="'+show_selected.join(",")+'" required>');

                                 $("#show_selected_seat").html(show_selected.join(", "));
                                     
                                    //$.each(selected, function(index, value){
                                       // $("#count").append(selected.join(", "));
                                   // });
                                
                                
                                 $("#show_price").html(data.price_info.price*$("input[type=checkbox]:checked").length);
                                 $("#show_total_price").html(data.price_info.price*$("input[type=checkbox]:checked").length);
                                 $("#show_discount").html(discount);
                                 grand_total_price=((100-discount)*(data.price_info.price*$("input[type=checkbox]:checked").length))/100
                                 $("#grand_total_price").html(grand_total_price);

                                 $("#grand_total_price2").html('<input type="hidden" class="check" name="grand_total_price" value="'+grand_total_price+'">');
                                 $("#total_seat_reserve").html('<input type="hidden" class="check" name="total_seat_reserve" value="'+$("input[type=checkbox]:checked").length+'">');
                               



                            });

                            //if(selected.length>0){
                               // console.log(selected);
                           // }

                              
                                
                            


                                                     
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