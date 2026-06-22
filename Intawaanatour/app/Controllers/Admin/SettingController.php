<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class SettingController extends BaseController
{
    protected SettingModel $model;

    /** Key pengaturan yang dikelola dari panel admin. */
    protected array $keys = [
        'site_name',
        'site_tagline_id',
        'site_tagline_en',
        'meta_description',
        'phone',
        'whatsapp',
        'email',
        'address',
        'operating_hours',
        'instagram',
        'facebook',
        'maps_embed',
    ];

    public function __construct()
    {
        $this->model = new SettingModel();
    }

    public function index()
    {
        return view('admin/settings/index', [
            'title'    => 'Pengaturan Situs',
            'settings' => $this->model->asMap(),
            'keys'     => $this->keys,
        ]);
    }

    public function update()
    {
        foreach ($this->keys as $key) {
            $this->model->put($key, (string) $this->request->getPost($key));
        }

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan disimpan.');
    }
}
