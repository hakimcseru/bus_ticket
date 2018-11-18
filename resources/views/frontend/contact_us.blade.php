@extends('frontend.app')
@section('owncss')
<style type="text/css">
	address { 
    display: block;
    font-style: italic;
}
hr {
    margin-top: 0px;
    margin-bottom: 10px;
    border-top: 1px solid #eee;
}
.margin_top{
	margin-top: 20px;
}
</style>

@endsection
@section('content')
<h1 class="mb-2 text-center">Contact Us</h1>
	
	@if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	@if(session('error-message'))
	<div class='alert alert-warning'>
		{{ session('message') }}
	</div>
	@endif
	

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
	<div class="row">
		
		<div class="col-md-8">
			<div class="margin_top">
				<form action="{{route('contact')}}" class="form-horizontal" role="form" method="POST" >
			        {{ csrf_field() }} 
					<div class="form-group">
			            <label class="col-sm-3 control-label">Name</label>
			            <div class="col-md-8">
			                <input type="text" class="form-control" placeholder="Enter your name" name="name" required="true">
			            </div>
			        </div>

			        <div class="form-group">
			            <label class="col-sm-3 control-label">Email </label>
			            <div class="col-md-8">
			                <input type="email" class="form-control" placeholder="Enter your email" name="email" required="true">
			            </div>
			        </div>

			        <div class="form-group">
			            <label class="col-sm-3 control-label">Subject</label>
			            <div class="col-md-8">
			                <input type="text" class="form-control" placeholder="Enter your Subject" name="subject" required="true">
			            </div>
			        </div>

			        <div class="form-group">
			            <label class="col-sm-3 control-label">Message</label>
			            <div class="col-md-8">
			                <textarea type="text" rows="10" class="form-control" placeholder="Type your Massage here" name="message" required="true"></textarea>
			            </div>
			        </div>

			        <div class="form-group">
			            <label class="col-sm-3 control-label"> </label>
			            <div class="col-md-8">
			                <button type="submit" class="btn btn-success" value="Send" name="send">Submit</button>
			            </div>
			        </div>
			    </form>
		    </div>
		</div>
		<div class="col-md-4">
			<h3>Address</h3><hr>
			<address>
				61, Red Crescent House, 9th Floor <br>
				Motijheel C/A <br>
				Dhaka 1000 <br>
				Phone: 02-47118362
			</address>
		</div>
	</div>
@endsection