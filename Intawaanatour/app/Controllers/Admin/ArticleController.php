<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    protected ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel();
    }

    public function index()
    {
        return view('admin/articles/index', [
            'title'    => 'Artikel',
            'articles' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('admin/articles/form', ['title' => 'Tambah Artikel', 'article' => null]);
    }

    public function edit($id)
    {
        $article = $this->model->find($id);
        if (! $article) {
            return redirect()->to('/admin/articles')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/articles/form', ['title' => 'Edit Artikel', 'article' => $article]);
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
        if (! $this->validate(['title_id' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title_id');
        $data  = [
            'slug'             => $this->request->getPost('slug') ?: url_title($title, '-', true),
            'title_id'         => $title,
            'title_en'         => $this->request->getPost('title_en'),
            'excerpt_id'       => $this->request->getPost('excerpt_id'),
            'excerpt_en'       => $this->request->getPost('excerpt_en'),
            'content_id'       => $this->request->getPost('content_id'),
            'content_en'       => $this->request->getPost('content_en'),
            'author'           => $this->request->getPost('author') ?: 'Tim Intawaanatour',
            'meta_description' => $this->request->getPost('meta_description'),
            'is_published'     => $this->request->getPost('is_published') ? 1 : 0,
            'published_at'     => $this->request->getPost('published_at') ?: date('Y-m-d H:i:s'),
        ];

        $cover = save_upload($this->request->getFile('cover_image'), 'articles');
        if ($cover) {
            $data['cover_image'] = $cover;
        }

        if ($id) {
            $this->model->update($id, $data);
        } else {
            $this->model->insert($data);
        }

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil disimpan.');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/admin/articles')->with('success', 'Artikel dihapus.');
    }
}
