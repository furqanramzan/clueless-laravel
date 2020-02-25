<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReviewComment;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ReviewCommentController extends Controller
{
    private $model;
    private $string;
    private $storage;
    private $view = "admin.auth.reviewcomment";
    private $route = "admin.reviewcomment";
    private $titles = [
        'plural' => 'review Comments',
        'singular' => 'review Comment'
    ];

    public function __construct(ReviewComment $model, Str $string)
    {
        $this->model = $model;
        $this->string = $string;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->model->review()->getModel()->with('reviewComments')->findorFail($id);
        $items = $item->reviewComments;

        $title = ucfirst($this->titles['plural']);
        $route = $this->route;
        $string = $this->string;

        return view($this->view . '.index', compact('items', 'title', 'route', 'string'));
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

        $item = $this->model->findorFail($id);
        $item->update($validated);

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.show', $item->review_id)->with([
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
        $item = $this->model->select('id', 'review_id')->findorFail($id);
        $item->delete();

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.show', $item->review_id)->with([
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
            'published' => 1,
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
            "body" => "required",
        ]);
    }
}
