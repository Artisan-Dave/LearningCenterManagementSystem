<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomeMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(){
        try{
            $EmailAddress = "almadindavep@gmail.com";
            $Message = "Hello World! Email testing from mailtrap";

           $response = Mail::to($EmailAddress)->send(new SendWelcomeMail($Message));

            dd($response);

        }catch (Exception $e){
            \Log::error("Unable to send Email" . $e->getMessage());
        }
    }
}
