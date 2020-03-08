<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ReviewController extends Controller
{
    private $model;
    private $storage;
    private $view = "admin.auth.review";
    private $route = "admin.review";
    private $titles = [
        'plural' => 'reviews',
        'singular' => 'review'
    ];

    public function __construct(Review $model, Storage $storage)
    {
        $this->model = $model;
        $this->storage = $storage;
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

        $items = $this->model->select('id', 'company_name', 'company_url', 'room_name', 'country', 'region', 'visits', 'published', 'created_at')->orderBy('created_at', 'desc')->get();
        return view($this->view . '.index', compact('items', 'title', 'route'));
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
            "image" => 'required|image'
        ], [], [
            'image' => 'thumbnail image',
        ]));

        $validated['image'] = $validated['image']->store('uploads/reviews', 'public_folder');
        if (isset($validated['detail_image'])) {
            $validated['detail_image'] = $validated['detail_image']->store('uploads/reviews', 'public_folder');
        }

        $this->model->create($validated);

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Created!",
            'message' => "The $title has been created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = $this->model->with(['reviewComments' => function ($query) {
            $query->select('review_id', 'body', 'created_at')->latest();
        }])->findorFail($id);
        $reviews = $this->model->orderBy('visits', 'desc')->limit(5)->get();
        return view('guest.review', compact('review', 'reviews'));
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
            "image" => "nullable|image|exclude_if:image," . null,
        ], [], [
            'image' => 'thumbnail image',
        ]));

        $item = $this->model->findorFail($id);

        if (isset($validated['image'])) {
            $validated['image'] = $validated['image']->store('uploads/reviews', 'public_folder');
            $this->storage->disk('public_folder')->delete($item->image);
        }
        if (isset($validated['detail_image'])) {
            $validated['detail_image'] = $validated['detail_image']->store('uploads/reviews', 'public_folder');
            $this->storage->disk('public_folder')->delete($item->detail_image);
        }

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
        $item = $this->model->select('id', 'image', 'detail_image')->findorFail($id);
        $this->storage->disk('public_folder')->delete($item->image);
        $this->storage->disk('public_folder')->delete($item->detail_image);
        $item->delete();

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Deleted!",
            'message' => "The $title has been deleted successfully"
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $item = $this->model->select('id', 'published', 'published_date')->findorFail($id);
        $item->update([
            'published' => !$item['published'],
            'published_date' => now(),
        ]);

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.index')->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Published!",
            'message' => "The $title has been published successfully"
        ]);
    }

    public function validateRequest($request)
    {
        return $request->validate([
            "company_name" => "required|max:190",
            "company_url" => "required",
            "room_name" => "required|max:190",
            "room_overview" => "required",
            "body" => "required",
            "country" => "required|max:190",
            "region" => "required|max:190",
            "puzzles_gameplay" => "required|numeric|max:10",
            "design_and_theming" => "required|numeric|max:10",
            "games_mastery" => "required|numeric|max:10",
            "innovation_tech" => "required|numeric|max:10",
            "overall" => "required|numeric|max:10",
            "time" => "required|max:190",
            "length" => "required|max:190",
            "accessibility" => "nullable|max:190",
            "value" => "required|max:190",
            "ideal_for" => "required|max:190",
            "jump_scares" => "boolean",
            "wheelchair" => "boolean",
            "is_closed" => "boolean",
            "good_for_kids" => "boolean",
            "good_for_enthusiasts" => "boolean",
            "good_for_design" => "boolean",
            "good_for_technology" => "boolean",
            "detail_image" => "nullable|image|exclude_if:detail_image," . null,
            // Todo 
            "average_price" => "required|numeric",
            "maximum_players" => "required|numeric",
            "minimum_players" => "required|numeric",
        ], [], [
            'detail_image' => 'banner image',
            'length' => 'game length',
        ]);
    }
}
