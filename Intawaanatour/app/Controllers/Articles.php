<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Articles extends BaseController
{
    public function index(): string
    {
        $model = new ArticleModel();

        return view('public/articles_index', [
            'meta' => [
                'title'       => t('Artikel & Tips Wisata Labuan Bajo', 'Labuan Bajo Travel Articles & Tips') . ' — Intawaanatour',
                'description' => t('Tips, itinerary, dan panduan lengkap menjelajahi Taman Nasional Komodo dan Labuan Bajo.', 'Tips, itineraries and complete guides to exploring Komodo National Park and Labuan Bajo.'),
                'image'       => 'assets/img/art-itinerary.jpg',
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Artikel', 'Articles'), 'url' => base_url('articles')],
                ],
            ],
            'articles' => $model->published()->findAll(),
        ]);
    }

    public function detail(string $slug)
    {
        $model   = new ArticleModel();
        $article = $model->bySlug($slug);

        if (! $article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $jsonld = json_encode([
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => base_url('articles/' . $article['slug'])],
            'headline'      => tr($article, 'title'),
            'image'         => img_url($article['cover_image']),
            'datePublished' => date('c', strtotime($article['published_at'] ?? $article['created_at'])),
            'dateModified'  => date('c', strtotime($article['updated_at'] ?? $article['published_at'] ?? $article['created_at'])),
            'author'        => ['@type' => 'Organization', 'name' => 'Intawaanatour', '@id' => base_url('/#organization')],
            'publisher'     => ['@id' => base_url('/#organization')],
            'inLanguage'    => locale(),
            'description'   => $article['meta_description'] ?? tr($article, 'excerpt'),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('public/article_detail', [
            'meta' => [
                'title'       => tr($article, 'title') . ' — Intawaanatour',
                'description' => $article['meta_description'] ?: tr($article, 'excerpt'),
                'image'       => $article['cover_image'],
                'og_type'     => 'article',
                'jsonld'      => $jsonld,
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Artikel', 'Articles'), 'url' => base_url('articles')],
                    ['name' => tr($article, 'title'), 'url' => base_url('articles/' . $article['slug'])],
                ],
            ],
            'article' => $article,
            'related' => $model->where('id !=', $article['id'])->latest(2),
        ]);
    }
}
