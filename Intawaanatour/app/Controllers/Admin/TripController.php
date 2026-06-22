<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripModel;
use App\Models\TripImageModel;

class TripController extends BaseController
{
    protected TripModel $trips;
    protected TripImageModel $images;

    public function __construct()
    {
        $this->trips  = new TripModel();
        $this->images = new TripImageModel();
    }

    public function index()
    {
        return view('admin/trips/index', [
            'title' => 'Paket Trip',
            'trips' => $this->trips->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('admin/trips/form', ['title' => 'Tambah Trip', 'trip' => null, 'images' => []]);
    }

    public function edit($id)
    {
        $trip = $this->trips->find($id);
        if (! $trip) {
            return redirect()->to('/admin/trips')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/trips/form', [
            'title'  => 'Edit Trip',
            'trip'   => $trip,
            'images' => $this->images->where('trip_id', $id)->orderBy('sort_order')->findAll(),
        ]);
    }

    public function create()
    {
        return $this->save();
    }

    public function update($id)
    {
        return $this->save((int) $id);
    }

    protected function save(?int $id = null)
    {
        $rules = [
            'title_id' => 'required|min_length[3]',
            'type'     => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title_id');
        $slug  = $this->request->getPost('slug') ?: url_title($title, '-', true);

        $data = [
            'slug'           => $slug,
            'type'           => $this->request->getPost('type'),
            'title_id'       => $title,
            'title_en'       => $this->request->getPost('title_en'),
            'price'          => (float) $this->request->getPost('price'),
            'duration_id'    => $this->request->getPost('duration_id'),
            'duration_en'    => $this->request->getPost('duration_en'),
            'capacity'       => $this->request->getPost('capacity'),
            'summary_id'     => $this->request->getPost('summary_id'),
            'summary_en'     => $this->request->getPost('summary_en'),
            'description_id' => $this->request->getPost('description_id'),
            'description_en' => $this->request->getPost('description_en'),
            'itinerary_id'   => $this->request->getPost('itinerary_id'),
            'itinerary_en'   => $this->request->getPost('itinerary_en'),
            'is_featured'    => $this->request->getPost('is_featured') ? 1 : 0,
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order'     => (int) $this->request->getPost('sort_order'),
        ];

        // Cover
        $cover = save_upload($this->request->getFile('cover_image'), 'trips');
        if ($cover) {
            $data['cover_image'] = $cover;
        }

        if ($id) {
            $this->trips->update($id, $data);
        } else {
            $this->trips->insert($data);
            $id = $this->trips->getInsertID();
        }

        // Galeri tambahan
        $files = $this->request->getFiles();
        if (! empty($files['gallery'])) {
            foreach ($files['gallery'] as $f) {
                $path = save_upload($f, 'trips');
                if ($path) {
                    $this->images->insert(['trip_id' => $id, 'image_path' => $path, 'sort_order' => 0]);
                }
            }
        }

        return redirect()->to('/admin/trips')->with('success', 'Trip berhasil disimpan.');
    }

    public function delete($id)
    {
        $this->images->where('trip_id', $id)->delete();
        $this->trips->delete($id);

        return redirect()->to('/admin/trips')->with('success', 'Trip dihapus.');
    }

    public function deleteImage($id)
    {
        $img = $this->images->find($id);
        $this->images->delete($id);

        return redirect()->back()->with('success', 'Gambar dihapus.');
    }
}
