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
    private $route = "admin.setting";
    private $titles = [
        'plural' => 'settings',
        'singular' => 'setting'
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
        $item = $this->model->select('id', 'key', 'name', 'value')->findorFail($id);

        $title = 'Setting';
        if ($item->key == 'contact_us') {
            $title = 'Contact Us';
        }
        if ($item->key == 'footer') {
            $title = 'Footer';
        }
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
