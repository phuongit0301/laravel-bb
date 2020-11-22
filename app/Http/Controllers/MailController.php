<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
	public function index() {
		return 123;
	}

    public function sendEmail(Request $request) { 
    	$title = '[Confirmation] Thank you for your register'; 
    	if(!$request->input('email')) {
    		return response()->json(['message' => 'Format is bad'], 400);
    	}

    	$sendmail = Mail::to($request->input('email'))->send(new SendMail($title, $request->input('email')));
    	if (empty($sendmail)) { 
    		return response()->json(['message' => 'Mail Sent Sucssfully'], 200); 
    	} else { 
    		return response()->json(['message' => 'Mail Sent fail'], 400);
    	}
    }
}
