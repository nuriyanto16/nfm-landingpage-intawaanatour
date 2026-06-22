<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table         = 'trips';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'slug', 'type', 'title_id', 'title_en', 'price',
        'duration_id', 'duration_en', 'capacity',
        'summary_id', 'summary_en', 'description_id', 'description_en',
        'itinerary_id', 'itinerary_en', 'cover_image',
        'is_featured', 'is_active', 'sort_order',
    ];

    public function active()
    {
        return $this->where('is_active', 1)->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC');
    }

    public function featured(int $limit = 3): array
    {
        return $this->where('is_active', 1)->where('is_featured', 1)
            ->orderBy('sort_order', 'ASC')->findAll($limit);
    }

    public function bySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->where('is_active', 1)->first();
    }

    public function images(int $tripId): array
    {
        return $this->db->table('trip_images')
            ->where('trip_id', $tripId)
            ->orderBy('sort_order', 'ASC')
            ->get()->getResultArray();
    }
}
