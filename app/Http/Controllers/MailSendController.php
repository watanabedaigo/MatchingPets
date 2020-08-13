<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\MailSend;

use App\Candidate;

class MailSendController extends Controller
{
    public function send($id){
    
        $to = [
            [
                'email' => 'wdaigm0801@gmail.com',
                'name' => 'test',
            ]
        ];
    
        $candidate = Candidate::find($id);
    
        Mail::to($to)->send(new MailSend($candidate));
    
        return view('candidatecoupon',[
            'candidate' => $candidate,
        ]);
    
    }
}
