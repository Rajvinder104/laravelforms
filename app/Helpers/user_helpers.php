<?php

use Illuminate\Support\Facades\DB;
use App\Models\user;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\welcomeemail;
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M, Y');
    }
}

// if (!function_exists('formatDate')) {
//     function formatDate($date)
//     {
//         // Parse the date using the format 'd/m/Y'
//         return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('d, M, Y');
//     }
// }

if (!function_exists('add')) {

    function add($table, $data)
    {
        $user_model = new user;
        return $user_model->add($table, $data);
    }
}
if (!function_exists('get_records')) {

    function get_records($table, $where, $select)
    {
        $user_model = new user;
        return $user_model->get_records($table, $where, $select);
    }
}
if (!function_exists('get_limit_records')) {

    function get_limit_records($table, $where, $select,  $perpage)
    {
        $user_model = new user;
        return $user_model->get_limit_records($table, $where, $select, $perpage);
    }
}

if (!function_exists('get_single_record')) {
    function get_single_record($table, $where, $select)
    {
        $user_model = new user;
        return $user_model->get_single_record($table, $where, $select);
    }
}
if (!function_exists('span_success')) {

    function span_success($message)
    {
        return '<div class="alert alert-icon alert-success" role="alert">
       <i class="fa fa-check-circle me-2" aria-hidden="true"></i>' . $message . '

    </div>';
    }
}

if (!function_exists('span_danger')) {

    function span_danger($message)
    {

        return '<div class="alert alert-icon alert-danger" role="alert">
       <i class="fa fa-frown-o me-2" aria-hidden="true"></i>' . $message . '

        </div>';
        return '<div class="alert alert-danger" role="alert"> </div>';
    }
}

if (!function_exists('span_info')) {

    function span_info($message)
    {
        return '<div class="alert alert-icon alert-info" role="alert">
               <i class="fa fa-bell-o me-2" aria-hidden="true"></i> ' . $message . '</div>';
    }
}

if (!function_exists('span_danger_simple')) {

    function span_danger_simple($message)
    {
        return '<span class="text-danger"> ' . $message . ' </span>';
    }
}

if (!function_exists('span_success_simple')) {

    function span_success_simple($message)
    {
        return '<span class="text-success"> ' . $message . ' </span>';
    }
}
if (!function_exists('span_info_simple')) {

    function span_info_simple($message)
    {
        return '<span class="text-info"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_success')) {

    function badge_success($message)
    {
        return '<span class="badge bg-success"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_danger')) {

    function badge_danger($message)
    {
        return '<span class="badge bg-danger"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_info')) {

    function badge_info($message)
    {
        return '<span class="badge bg-info"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_warning')) {

    function badge_warning($message)
    {
        return '<span class="badge bg-warning"> ' . $message . ' </span>';
    }
}
// if (!function_exists('sendEmail')) {
//     function sendEmail($email1, $subject1, $message1, $display = false)
//     {
//         $toEmail = $email1;
//         $message = $message1;
//         $subject = $subject1;
//         $res =   Mail::to($toEmail)->send(new welcomeemail($message, $subject));
//     }
// }
