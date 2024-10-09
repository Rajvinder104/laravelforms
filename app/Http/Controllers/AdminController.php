<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response['header'] = 'Admin Login';
        $response['form_open'] = Form::open(['route' => 'admin.store']);
        $response['form'] = [
            'email' => Form::label('email', 'Email') . Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'email']),
            'password' => Form::label('password', 'Password') . Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'password']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'form-control btn-brand']);
        return view('forms', $response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        // die;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($request['email'] == 'admin@gmail.com' && $request['password'] == 'admin123') {
            return redirect()->route('admin.index');
        } else {
            // return Redirect::back()->withErrors(['email' => 'These credentials do not match our records.']);
            return redirect()->route('admin.create')->with('message', span_danger('These credentials do not match our records'));
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
}
