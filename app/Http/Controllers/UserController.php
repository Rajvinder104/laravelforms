<?php

namespace App\Http\Controllers;

use Log;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $response['header'] = 'Users Details';
        // $where = [['Paid_status', '<', 1], ['package_amount', '>', 0]];
        $where = [];
        $response['records'] = get_limit_records('users',  $where, '*', 10);

        $response['field'] = '<div class="row">
            <div class="col-4">
            <a href="' .  route('user.create') . '" class="btn btn-primary btn-sm">Add New User</a>
            </div>
            </div>';
        $response['thead'] = '<tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>status</th>
            <th>Date</th>
            </tr>';

        $tbody = [];
        $i = ($response['records']->currentPage() - 1) * $response['records']->perPage() + 1;

        foreach ($response['records'] as $key => $rec) {
            if ($rec->Paid_status == 0) {
                $status =  badge_warning('Pending');
            } elseif ($rec->Paid_status == 1) {
                $status = badge_success('Approved');
            } else {
                $status = badge_danger('Rejected');
            }
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $rec->name . '</td>
                                <td>' . $rec->email . '</td>
                                <td>' . $rec->phone . '</td>
                                <td>' .  $status . '</td>
                                <td>' . formatDate($rec->created_at) . '</td>
                             </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        $response['i'] = $i;

        return view('reports', $response);
    }



    public function create()
    {
        $response['header'] = 'Join Our Community';
        $response['form_open'] = Form::open(['route' => 'user.store']);
        $response['form'] = [
            'name' => Form::label('name', 'Name') . Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Your Name']),
            'email' => Form::label('email', 'Email') . Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter Your Email Address']),
            'password' => Form::label('password', 'Password') . Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Your Password']),
            'phone' => Form::label('phone', 'Phone') . Form::text('phone', old('phone'), ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Enter Your Phone Number']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'w-100 btn btn-info mt-4']);
        return view('forms', $response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $checkEmail =  get_single_record('users', ['email' => $request->email], '*');
        if (empty($checkEmail)) {
            $data = $request->validate([
                'name' => 'required',
                // 'email' => 'required|email|unique:users,email',
                'email' => 'required',
                'password' => 'required',
                'phone' => 'required|integer',
            ]);
            $users = add('users', $data);
            if ($users) {
                return redirect()->route('user.index')->with('message', span_success('User Details Inserred Successfully'));
            }
        } else {
            // return redirect()->route('user.create')->with('message', 'Email Address already Exists! Try another email')->with('type', 'danger');
            return redirect()->route('user.create')->with('message', span_danger('Email Address already Exists! Try another email'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function helpers()
    {
        // $where = [];
        // $users = get_records('users', $where, '*');
        // return $users;

        $date = '22-9-2024';

        $data =    formatDate($date);
        return $data;
    }

    public function Send_Email()
    {
        $mail =  Composemail('rajvinder0044@gmail.com', 'Testing', 'Testing Testing', true);
        if ($mail) {
            echo  span_success('Email sent successfully to Rajvinder');
        }
    }

    public function SendEmailform()
    {
        $response['header'] = 'Send Email';
        $response['form_open'] = Form::open(['route' => 'contact', 'files' => true, 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'name' => Form::label('name', 'Name') . Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Your Name']),
            'email' => Form::label('email', 'Email') . Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter Your Email Address']),
            'password' => Form::label('password', 'Password') . Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Your Password']),
            'phone' => Form::label('phone', 'Phone') . Form::text('phone', old('phone'), ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Enter Your Phone Number']),
            'media' => Form::label('media', 'Media', ['class' => 'custom-file-label']) . Form::file('media', ['id' => 'media', 'class' => 'custom-file-input']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'w-100 btn btn-info mt-4']);
        return view('forms', $response);
    }
    public function SendEmailfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'media' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        $filename = time() . '.' . $request->file('media')->extension();
        $request->file('media')->move('uploads', $filename);
        $all =  $request->all();
        Composemailfile('gnirajvinder@gmail.com', $all, $filename);
        if ($filename) {
            return back()->with('message', span_success('Thanks for Contacting us.'));
        } else {
            return back()->with('message', span_danger('Try Again !!'));
        }
    }
}
