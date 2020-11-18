<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request) { 
    	$title = '[Confirmation] Thank you for your register'; 
    	if(!$request->input('email') || !$request->hasFile('image')) {
    		return response()->json(['message' => 'Format is bad'], 400);
    	}

    	$image = $request->file('image');
    	$image->newImageName = time().'-'. $image->getClientOriginalName();
    	$realPath = public_path().'/img/'. $image->newImageName;

    	$image->move(public_path().'/img/', $image->newImageName);

    	$sendmail = Mail::to($request->input('email'))->send(new SendMail($title, $image, $realPath));
    	if (empty($sendmail)) { 
    		return response()->json(['message' => 'Mail Sent Sucssfully'], 200); 
    	} else { 
    		return response()->json(['message' => 'Mail Sent fail'], 400);
    	}
    }
}
