<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;

class GalleryController extends BaseController
{
    public function index()
    {
        return view('admin/gallery/index', [
            'title' => 'Galeri',
            'items' => (new GalleryModel())->ordered(),
        ]);
    }

    public function create()
    {
        $model = new GalleryModel();
        $files = $this->request->getFiles();
        $count = 0;

        if (! empty($files['images'])) {
            foreach ($files['images'] as $f) {
                $path = save_upload($f, 'gallery');
                if ($path) {
                    $model->insert([
                        'title'      => $this->request->getPost('title') ?: 'Foto',
                        'image_path' => $path,
                        'category'   => $this->request->getPost('category') ?: 'Umum',
                        'sort_order' => 0,
                    ]);
                    $count++;
                }
            }
        }

        return redirect()->to('/admin/gallery')->with('success', "$count foto diunggah.");
    }

    public function delete($id)
    {
        (new GalleryModel())->delete($id);

        return redirect()->to('/admin/gallery')->with('success', 'Foto dihapus.');
    }
}
