<?php

namespace App\Http\Controllers;

use App\Models\popup;
use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response['header'] = 'Popup Image';
        $response['records'] = popup::paginate(2);

        $response['field'] = '<div class="row">
        <div class="col-4">
        <a href="' .  route('popup.create') . '" class="btn btn-primary btn-sm">Add popup Image</a>
        </div>
        </div>';
        $response['thead'] = '<tr>
        <th>#</th>
        <th>Caption</th>
        <th>Media</th>
        <th>Action</th>

        </tr>';
        $tbody = [];
        $i = ($response['records']->currentPage() - 1) * $response['records']->perPage() + 1;
        foreach ($response['records'] as $key => $rec) {
            $imageUrl = asset('storage/' . $rec->media);
            $tbody[$key]  = ' <tr>
                            <td>' . $i . '</td>
                            <td>' . $rec->caption . '</td>
                           <td><img src="' . $imageUrl . '" width="100"></td>
                           <td><a href="' . route("popup.show", ['popup' => $rec->id]) . '" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td>
                         </tr>';

            $i++;
        }
        $response['tbody'] = $tbody;
        $response['i'] = $i;
        return view('reports', $response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response['header'] = 'Add User Popup Image';
        $response['form_open'] = Form::open(['route' => 'popup.store', 'files' => true, 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'caption' => Form::label('caption', 'Caption') . Form::text('caption', null, ['id' => 'caption', 'class' => 'form-control', 'placeholder' => 'Caption']),
            'media' => Form::label('media', 'Media', ['class' => 'custom-file-label']) . Form::file('media', ['id' => 'media', 'class' => 'custom-file-input']),
            // 'media' => Form::label('media', 'Media') . Form::file('media', null, ['id' => 'media', 'class' => 'form-control']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'form-control btn-brand']);
        return view('forms', $response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =    $request->validate([
            'caption' => 'required',
            'media' => 'required|file'
        ]);
        // $originalFileName = $request->file('media')->getClientOriginalName();
        // $path = $request->file('media')->storeAs('images', $originalFileName, 'public');
        $path = $request->file('media')->store('images', 'public');
        $userdata = popup::create([
            'caption' => $request->caption,
            'media' =>  $path,
        ]);
        if ($userdata) {
            return redirect()->route('popup.index')->with('message', 'User image Uploaded Successfully.')->with('type', 'success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $popupimg = popup::findOrFail($id);
        $response['header'] = 'Update User Popup Image';
        $response['form_open'] = Form::model($popupimg, ['route' => ['popup.update', $id], 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']);
        $response['form'] = [
            'caption' => Form::label('caption', 'Caption') . Form::text('caption', null, ['id' => 'caption', 'class' => 'form-control', 'placeholder' => 'Caption']),
            'media' => Form::label('media', 'Media', ['class' => 'custom-file-label']) . Form::file('media', ['id' => 'media', 'class' => 'custom-file-input']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'form-control btn-brand']);
        return view('forms', $response);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'caption' => 'required|string',
            'media' => 'nullable|file',
        ]);
        $popup = popup::findOrFail($id);
        $popup->caption = $request->caption;
        if ($request->hasFile('media')) {
            $oldImagePath = public_path('storage/' . $popup->media);
            if (file_exists($oldImagePath)) {
                @unlink($oldImagePath);
            }
            $path = $request->file('media')->store('images', 'public');
            $popup->media = $path;
        }
        $popup->save();
        return redirect()->route('popup.index')->with('message', 'User Image Data Updated Successfully')->with('type', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
