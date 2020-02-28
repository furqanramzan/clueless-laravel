<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    private $model;
    private $hash;
    private $view = "admin.auth.setting";
    private $route = "admin.contact";
    private $titles = [
        'plural' => 'contacts',
        'singular' => 'contact'
    ];

    public function __construct(Setting $model)
    {
        $this->model = $model;
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

        $item = $this->model->select('id', 'name', 'value')->findorFail($id);

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
        $validated = $request->validate([
            "value" => "required",
        ]);
        
        $item = $this->model->findorFail($id);
        $item->update($validated);

        cache()->forget('settings');

        $title = $this->titles['singular'];

        return redirect()->route($this->route . '.edit', $item->id)->with([
            'type' => 'success',
            'title' => ucfirst($title) . " Updated!",
            'message' => "The $title has been updated successfully"
        ]);
    }
}
