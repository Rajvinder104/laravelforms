<?php

namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

class ManagementController extends Controller
{
    protected $news;

    public function __construct(news $news)
    {
        // parent::__construct();
        $this->news = $news;
    }
    public function index()
    {
        $response['header'] = 'News';
        $where = [];
        $response['records'] = get_limit_records('news', $where, '*', true, 10); // Ensure paginate is true
        $response['field'] = '<div class="row">
        <div class="col-4">
        <a href="' . route('form.create') . '" class="btn btn-warning btn-sm">Create News</a>
        </div>
        </div>';
        $response['thead'] = '<tr>
        <th>#</th>
        <th>Title</th>
        <th>News</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Name</th>
        <th>Package</th>
        </tr>';

        $tbody = [];
        $i = ($response['records']->currentPage() - 1) * $response['records']->perPage() + 1;

        foreach ($response['records'] as $key => $rec) {

            $package = $this->news->get_single_record('users', ['user_id' => $rec->user_id], 'name, IFNULL(SUM(package_amount), 0) as total');

            $totalPackageAmount = $package ? $package->total : 0;
            $tbody[$key] = '<tr>
                            <td>' . $i . '</td>
                            <td>' . $rec->title . '</td>
                            <td>' . $rec->news . '</td>
                            <td>' . $rec->created_at . '</td>

                            <td><a href="' . route("manage.show", ['manage' => $rec->id]) . '" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td>
                                <form action="' . route("manage.destroy", ['manage' => $rec->id]) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-outline-warning btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>' . ($package ? $package->name : 'N/A') . '</td>
                            <td>' . $totalPackageAmount . '</td>

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $newsItem = News::findOrFail($id);

        // echo '<pre>';
        // print_r($newsItem);
        // echo '</pre>';
        // die;
        $user  = $this->news->get_single_record2('news', ['id' => $id], '*');
        $response['header'] = 'Edit News';
        $response['form_open'] = Form::model($user, ['route' => ['form.update', $id], 'method' => 'PUT']);
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
        $user  = $this->news->get_single_record2('news', ['id' => $id], '*');

        $user->update([
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
        //
    }
}
