<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TopListReview;
use App\Http\Controllers\Controller;

class TopListReviewController extends Controller
{
    private $model;
    private $string;
    private $view = "admin.auth.toplistreview";
    private $route = "admin.toplistreview";
    private $titles = [
        'plural' => 'top List Reviews',
        'singular' => 'top List Review'
    ];

    public function __construct(TopListReview $model, Str $string)
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

        $items = $this->model->with(['topList:id,name', 'review:id,room_name'])->orderBy('created_at', 'desc')->get();
        return view($this->view . '.index', compact('items', 'title', 'route', 'string'));
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

        $related = $this->related();

        return view($this->view . '.create', compact('related', 'title', 'route'));
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
        $related = $this->related();

        $title = ucfirst($this->titles['singular']);
        $route = $this->route;


        return view($this->view . '.edit', compact('item', 'related', 'title', 'route'));
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

    public function related()
    {
        $related = [];
        $related['topList'] = $this->model->topList()->getModel()->select('id', 'name')->get();
        $related['review'] = $this->model->review()->getModel()->select('id', 'room_name')->get();
        return $related;
    }

    public function validateRequest($request)
    {
        $validated = $request->validate([
            "top_list" => "required|numeric|exists:top_lists,id",
            "review" => "required|numeric|exists:reviews,id",
            "overview" => "required",
            "order" => "required|numeric",
        ]);
        $validated['top_list_id'] = $validated['top_list'];
        $validated['review_id'] = $validated['review'];
        return $validated;
    }
}
