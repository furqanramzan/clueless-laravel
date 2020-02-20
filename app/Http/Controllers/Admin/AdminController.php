<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    private $model;
    private $view = "admin.pages.admin";
    private $route = "admin.admin";
    private $titles = [
        'plural' => 'admins',
        'singular' => 'admin'
    ];

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
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

        $admins = $this->model->select('id', 'name', 'email', 'created_at')->orderBy('created_at', 'desc')->get();
        return view($this->view . '.index', compact('admins', 'title', 'route'));
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
        $validated = $request->validate([
            "name" => "required|max:190",
            "email" => "required|max:190|unique:admins",
            "password" => "required|min:8|max:190|confirmed",
        ]);

        $title = $this->titles['singular'];

        $this->model->create($validated);

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
        $title = ucfirst($this->titles['singular']);
        $route = $this->route;

        $admin = $this->model->select('id', 'name', 'email')->findorFail($id);

        return view($this->view . '.edit', compact('admin', 'title', 'route'));
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
        $validated = $request->validate([
            "name" => "required|max:190",
            "email" => "required|max:190|unique:admins,email," . $id,
            "password" => "nullable|min:8|max:190|confirmed|exclude_if:password," . null,
        ]);
        
        $admin = $this->model->findorFail($id);
        $admin->update($validated);

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
        $admin = $this->model->select('id')->findorFail($id);
        $admin->delete();

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Deleted!",
            'message' => "The $title has been deleted successfully"
        ]);
    }
}
