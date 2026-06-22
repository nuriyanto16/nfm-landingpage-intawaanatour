<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table         = 'articles';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'slug', 'title_id', 'title_en', 'excerpt_id', 'excerpt_en',
        'content_id', 'content_en', 'cover_image', 'author',
        'meta_description', 'is_published', 'published_at',
    ];

    public function published()
    {
        return $this->where('is_published', 1)->orderBy('published_at', 'DESC');
    }

    public function bySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->where('is_published', 1)->first();
    }

    public function latest(int $limit = 3): array
    {
        return $this->where('is_published', 1)->orderBy('published_at', 'DESC')->findAll($limit);
    }
}
