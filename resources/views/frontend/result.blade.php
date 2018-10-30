@extends('frontend.app')

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
.total_seat span ul li:nth-child(2n) {

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
</style>
@endsection

<?php

use App\Price;

?>
    @section('content')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                 @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-bordered">
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
                               
                               
                                <button type="button" id="{{ $available_single_bus->id }}"  class="booking btn btn-primary">booking</button>
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
                                                <div id="hidden_selected_seat"></div>  
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <div id="grand_total_price2"></div>  
                                            </div>
                                        </div>

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
                            <h4 class="modal-title" id="myModalLabel">Booking User Information</h4>
                          </div>
                          <div class="modal-body">
                              {!! Form::open(array('route' => 'booking.store','method'=>'POST', 'files' => true, 'runat'=>'server')) !!}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <strong>Name :</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                     {!! Form::text('name', null, array('placeholder' => 'Name', 'required' => 'required','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <strong>Email <span style="color: red">*</span> :</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                                    {!! Form::text('email', null, array('placeholder' => 'Email', 'required' => 'required','class' => 'form-control')) !!}

                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <strong>Contact number <span style="color: red">*</span>:</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    {!! Form::text('contact_number', null, array('placeholder' => 'Contact number', 'required' => 'required','class' => 'form-control')) !!}

                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <strong>Address :</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                    {!! Form::textarea('address', null, array('placeholder' => 'Address','class' => 'form-control','rows'=>6)) !!}
                                                </div>
                                            </div>
                                          </div> 
                                    </div>  
                                    <div class="col-xs-6 col-sm-6 col-md-6">  
                                     
    
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <table class="table">
                                                      <tbody>
                                                        <tr>
                                                          <td>Seat</td>
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
                                                <strong>Hand cash <span style="color: red">*</span>:</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    {!! Form::text('grand_toal', null, array('placeholder' => 'grnd_total','class' => 'form-control')) !!}

                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <strong>Payment System<span style="color: red">*</span>:</strong>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    {!! Form::text('ssl', null, array('placeholder' => 'ssl','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                          </div>

                                         
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-success bookingnext">Submit</button>
                                        </div>

                                       
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
                $('#myModal').modal('show');  

                $.ajax({
                    url: '{{Request::root()}}/bookingfront/'+assign_id,
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

                            var count=0; 
                            var str = '<div class="total_seat">'
                            $.each(data.seat_number, function(index,item){
                              
                              count=count+1; 
                              if(index==0){
                                str += '<span class="listiteam'+index+'"><ul>'
                              }
                               
                              str += '<li class="listiteam'+index+'"><div  style="position:relative;"><input type="checkbox" id="'+item+'" class="check trigger" name="select_seat_number" value="'+item+'"> <label for="'+item+'" class="checker"><span class="pob" style="    position: absolute;\n' +
                                  '    left: 30%;\n' +
                                  '    top: 20%;">'+item+'</span></label></div></li>';
                              if(index!=0 && count%4==0){
                                 str += '</ul></span><span class="listiteam'+index+'"><ul>'
                              }


                            });
                            str += '<ul></span></div>';
                            document.getElementById("seat_plan_number").innerHTML = str;


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
                                 $("#hidden_selected_seat").html('<input type="hidden" class="check" name="order_seat" value="'+show_selected.join(",")+'">');

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
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

                var form_action = $("#bookingdata-item").find("form").attr("action");
                var pickup_location = $("#bookingdata-item").find("select[name='pickup_location']").val();
                var drop_location = $("#bookingdata-item").find("select[name='drop_location']").val();
                var order_seat = $("#bookingdata-item").find("input[name='order_seat']").val();
                var grand_total_price = $("#bookingdata-item").find("input[name='grand_total_price']").val();

                //alert(order_seat);

                $('#myModal').modal('hide');  
                $('#myModalnext').modal('show');  

                $.ajax({
                    url: form_action,
                    type: "POST",
                    dataType: "json",
                    data:{pickup_location:pickup_location, drop_location:drop_location, order_seat:order_seat,grand_total_price:grand_total_price},
                    success:function(data) {
                            

                                                     
                    }
                });

                
        });
    });

</script>

@endsection