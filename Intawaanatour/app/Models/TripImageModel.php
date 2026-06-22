<?php

namespace App\Models;

use CodeIgniter\Model;

class TripImageModel extends Model
{
    protected $table         = 'trip_images';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $returnType    = 'array';
    protected $allowedFields = ['trip_id', 'image_path', 'sort_order'];
}
