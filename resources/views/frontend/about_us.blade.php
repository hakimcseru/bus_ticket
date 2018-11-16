@extends('frontend.app')
@section('owncss')
<style type="text/css">
	p{
		text-align: justify;
	}
	.shadow{
		box-shadow: 0px 2px 8px 2px #eee;
	    margin-top: 10px;
	    margin-bottom: 17px;
	}
	hr {
    margin-top: 0px;
    margin-bottom: 10px;
    border-top: 4px solid #185c83;
}
</style>

@endsection
@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1 shadow">
			<h1>About Us</h1><hr>
			<p>E-business today has embodied an electronic transformation of our culture. This transformation has emerged in the use of technology, which has become pervasive throughout our daily life. One of the problems that this use of technology has brought to us is the user unfriendliness that is often its byproduct. One of the latest trends has been to enable users to utilize technology more effectively, with less hassle and to make technology transparent in its use.The concept of online ticketing is not new worldwide, it is still finding its market presence in Bangladesh at the same time demanding an easier, faster and effective ticketing booking and reservation system unlike the age old time consuming and tedious system. As our people are getting more technology and time conscious preferring online transaction, we have come up with <a href="{{ route('font_web.index') }}">albarakaex.com.</a></p>
<p><a href="{{ route('font_web.index') }}">albarakaex.com</a> is a One Stop Online Bus Ticket Booking solution portal launched by intouchsoft for private luxury and deluxe express Bus Operators in Bangladesh. No matter where we are we can book our tickets without going to the bus counter and all that we need is just an internet connection and computer to get tickets.</p>
<p>In the past, we never thought of buying bus tickets through online platform as it was relied on counters and agents. Now, with intouch innovative concept, bus travelers can find respective destination and can schedule their bus journey through our service portal with just a few clicks. Bus departure times along with bus fares and relevant information will be displayed while booking tickets, payment can be made online as well as offline with multiple options, 24 hour call center support with agent networks, all integrated in one solution. It will provide our passengers best possible option for travelling by bus. Our online coach booking and reservation system guarantees that both money and time is saved. <strong>Our idea is simple:</strong> To serve people with e-solutions which are multi-functional.We make reselling very easy. We started with the premise of reselling bus travel tickets, not necessarily under our brand, but to everyone through our platform and services in every neighborhood and deliver great customer service. We have always prided ourselves in attempting and solving problems which makes the life of consumers and clients simple. What we have achieved today is that we have made travel accessible to a common man, in each and every corner of Bangladesh through clients and agents, bringing the bus industry online, building the first known reservation systems for bus operators to enable bus bookings in early 2012, be the first ones to build a automatic ticket booking solution, or now launching a totally different way of booking travel. We believe customer service starts with listening to the customer, owning what is wrong and then to eradicate it. We fundamentally believe most problems can be eliminated by listening and planning.</p>
		</div>
	</div>
@endsection