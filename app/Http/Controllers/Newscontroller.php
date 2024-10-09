<?php

namespace App\Http\Controllers;

use App\Models\news;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

class Newscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response['header'] = 'News';
        $response['records'] = news::paginate(2);

        $response['field'] = '<div class="row">
        <div class="col-4">
        <a href="' .  route('form.create') . '" class="btn btn-warning btn-sm">Create News</a>
        </div>
        </div>';
        $response['thead'] = '<tr>
        <th>#</th>
        <th>Title</th>
        <th>News</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>

        </tr>';
        $tbody = [];
        $i = ($response['records']->currentPage() - 1) * $response['records']->perPage() + 1;
        foreach ($response['records'] as $key => $rec) {
            $tbody[$key]  = ' <tr>
                            <td>' . $i . '</td>
                            <td>' . $rec->title . '</td>
                            <td>' . $rec->news . '</td>
                            <td>' . $rec->created_at . '</td>
                           <td><a href="' . route("form.show", ['form' => $rec->id]) . '" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td>
                         <form action="' . route("form.destroy", ['form' => $rec->id]) . '" method="POST" style="display:inline;">
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                             <button type="submit" class="btn btn-outline-warning btn-sm">
                                 <i class="fa-solid fa-trash"></i>
                             </button>
                         </form>
                     </td>


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
        $response['header'] = 'Create News';
        $response['form_open'] = Form::open(['route' => 'form.store']);
        $response['form'] = [
            'title' => Form::label('title', 'Title') . Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Title']),
            'news' => Form::label('news', 'News') . Form::textarea('news', null, ['id' => 'news', 'class' => 'form-control', 'placeholder' => 'News']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'form-control btn-brand']);
        return view('forms', $response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'news' => 'required',
        ]);

        $users = news::create($data);
        if ($users) {
            return redirect()->route('form.index')->with('message', 'Data Inserted successfully')->with('type', 'success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $newsItem = News::findOrFail($id);

        // echo '<pre>';
        // print_r($newsItem);
        // echo '</pre>';
        // die;
        $response['header'] = 'Edit News';
        $response['form_open'] = Form::model($newsItem, ['route' => ['form.update', $id], 'method' => 'PUT']);
        $response['form'] = [
            'title' => Form::label('title', 'Title') . Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Title']),
            'news' => Form::label('news', 'News') . Form::textarea('news', null, ['id' => 'news', 'class' => 'form-control', 'placeholder' => 'News']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'form-control btn-brand']);
        return view('forms', $response);
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
        $data = $request->validate([
            'title' => 'required',
            'news' => 'required',
        ]);

        news::find($id)
            ->update([
                'title' => $request->title,
                'news' => $request->news,
            ]);
        return redirect()->route('form.index')
            ->with('message', ' Data Updated Successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        news::destroy($id);
        return redirect()->route('form.index')
            ->with('message', ' Data Deleted Successfully')->with('type', 'success');
    }


    public function admin()
    {

        DB::table('tbl_admins')->insert([
            'password' => 'admin123',
            'created_at' => now(),  // Optional: for timestamp fields
            'updated_at' => now()   // Optional: for timestamp fields
        ]);
    }


}
