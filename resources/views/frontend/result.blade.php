@extends('frontend.app')

@section('owncss')
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                          </div>
                          <div class="modal-body">
                                 <div id="seat_plan_number">
                                 </div>

                                 <div id="count"></div>   
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                    </div>
                </div>

               
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
              
                var assign_id=$(this).attr('id');
                $('#myModal').modal('show');  

                $.ajax({
                    url: '{{Request::root()}}/bookingfront/'+assign_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                            console.log(data);

                            var str = '<ul>'
                            $.each(data.seat_number, function(index,item){
                              str += '<li><input type="checkbox" class="check" name="select_seat_number" value="'+item+'">'+item+'</li>';
                            });
                            str += '</ul>';
                            document.getElementById("seat_plan_number").innerHTML = str;

                            

                            $("input[type=checkbox]").click(function () {

                                $("#count").html($("input[type=checkbox]:checked").length);

                                if($(this).is(':checked')){
                                     selected.push($(this).val());
                                }else{
                                     selected.splice($.inArray($(this).val(), selected),1);
                                }    
                                alert(selected);

                            });

                            


                                                     
                    }
                });
        });
    });

</script>

@endsection