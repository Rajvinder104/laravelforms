<?php

use App\Mail\composemail;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeemail;

if (!function_exists('Composemail')) {
    function Composemail($email1, $subject1, $message1, $display = true)
    {
        $toEmail = $email1;
        $message = $message1;
        $subject = $subject1;
        $res =   Mail::to($toEmail)->send(new welcomeemail($message, $subject));
    }
}

if (!function_exists('Composemailfile')) {
    function Composemailfile($email1, $request1, $filename1)
    {
        $toEmail = $email1;
        $request = $request1;
        $filename = $filename1;
        $res =   Mail::to($toEmail)->send(new composemail($request, $filename));
    }
}
