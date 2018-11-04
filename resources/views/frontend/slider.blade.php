<ul id="slider" class="bxslider">
    <li><img src="http://localhost:8000/images/image-gallery/slider4.jpg" alt=""/></li>
    <li><img src="http://localhost:8000/images/image-gallery/slider5.jpg" alt=""/></li>
    <li><img src="http://localhost:8000/images/image-gallery/slider6.jpg" alt=""/></li>
</ul>
<div class="ticket_header_filter_area" {{--style="background-image: url(http://127.0.0.1:8000/images/ticket/header_img.png);
    background-repeat: no-repeat, repeat;
    background-size: cover;
    background-position: center;
    background-position: 100% 100%;
    padding: 130px 0;"--}}>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 search_wrapper">
                <div class="ticket_header_filter ticket_header_filter_left">
                    <h4  style="text-align: center;color: #e34b4d;">Online Bus Tickets Booking with Zero Booking Fees</h4>
				<?php 
				use App\Location;
				$locations = Location::pluck('name','name');
				?>
                         {!! Form::open(array('route' => 'font_web.index','method'=>'GET')) !!}
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">From<span style="color: red;">*</span></label>
                                    
                                     {!! Form::select('start_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">To<span style="color: red;">*</span></label>
                                    
                                     {!! Form::select('end_point', $locations, [], array('required' => 'required','class' => 'form-control')) !!}
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputEmail1">Date of Journey<span style="color: red;">*</span></label>
                                    <input type="text" name="start_date" class="form-control" id="start_date" placeholder="Start Date">
                                      <i class="fa fa-calendar" id="start_date5" aria-hidden="true"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                  <div class="form-group ticket_custom_calader_icon">
                                    <label for="exampleInputPassword1">Date of Return</label>
                                    <input type="text" name="return_date" class="form-control" id="return_date" placeholder="Return Date">
                                    <i class="fa fa-calendar" id="return_date1" aria-hidden="true"></i>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-lg-6 col-xs-6">
                                  <div class="form-group">
                                   <button type="reset" class="btn btn-danger" style="width:150px">Reset</button>
                                  </div>
                                </div> --}}
                                <div class="col-lg-6 col-xs-6 col-md-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-3">
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block" style=""><i class="fa fa-search"></i> Search Buses</button>
                                  </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                <div class="ticket_header_filter">
                      {{--<img  style="width: 73%;float: right;padding-top: 35px;" src="{{Request::root()}}/images/ticket/bus_transparent.png">--}}
                </div>
            </div>
        </div>
    </div>
</div>