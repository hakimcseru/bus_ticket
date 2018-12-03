<?php

namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Admin;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function show() 
	{
		return view('frontend.contact_us');
	}
    public function feedback() 
	{
		return view('frontend.feedback');
    }
    
    public function complain() 
	{
		return view('frontend.complain');
	}
    /*public function mailToAdmin(ContactFormRequest $message, Admin $admin)
	{        //send the admin an notification
		$admin->notify(new InboxMessage($message));
        print
		// redirect the user back
		return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
	}*/

    public function mailToAdmin(Request $request)
	{        //send the admin an notification
            $this->validate($request, [
            'email' => 'required | email',
            'name' => 'required',
            'message' => 'required'
        ]);
        $data = $request->all();
        $to = "hakimcseru@gmail.com";
        $subject = "Contact - ".$data['subject'];
        $txt = $data['message'];
        $headers = "From: ".$data['email']. "\r\n" .
        "CC: ealivehakim@gmail.com"; 

        try {
        //check if
        mail($to,$subject,$txt,$headers);
		return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
        }

        catch (customException $e) {
        return redirect()->back()->with('error-message', 'There is an error sending the email!');
        }


	}
}
