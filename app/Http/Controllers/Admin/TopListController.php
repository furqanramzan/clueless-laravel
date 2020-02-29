<?php

namespace App\Http\Controllers\Admin;

use App\Models\TopList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopListController extends Controller
{
    private $model;
    private $string;
    private $view = "admin.auth.toplist";
    private $route = "admin.toplist";
    private $titles = [
        'plural' => 'top Lists',
        'singular' => 'top List'
    ];

    public function __construct(TopList $model, Str $string)
    {
        $this->model = $model;
        $this->string = $string;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = ucfirst($this->titles['plural']);
        $route = $this->route;
        $string = $this->string;

        $items = $this->model->orderBy('created_at', 'desc')->get();
        return view($this->view . '.index', compact('items', 'string', 'title', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = ucfirst($this->titles['singular']);
        $route = $this->route;
        return view($this->view . '.create', compact('title', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $validated = array_merge($validated, $request->validate([
            "order" => "required|numeric|unique:top_lists",
        ]));

        $this->model->create($validated);

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Created!",
            'message' => "The $title has been created successfully"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->model->findorFail($id);

        $title = ucfirst($this->titles['singular']);
        $route = $this->route;


        return view($this->view . '.edit', compact('item', 'title', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateRequest($request);
        $validated = array_merge($validated, $request->validate([
            "order" => "required|numeric|unique:top_lists,order,".$id,
        ]));

        $item = $this->model->findorFail($id);
        $item->update($validated);

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Updated!",
            'message' => "The $title has been updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->model->select('id')->findorFail($id);
        $item->delete();

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Deleted!",
            'message' => "The $title has been deleted successfully"
        ]);
    }

    public function validateRequest($request)
    {
        return $request->validate([
            "name" => "required|max:190",
            "title" => "required|max:190",
            "introduction" => "required",
        ]);
    }
}
