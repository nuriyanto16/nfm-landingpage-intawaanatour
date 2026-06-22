<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table         = 'bookings';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $updatedField  = '';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'name', 'email', 'phone', 'trip_id', 'trip_date', 'pax', 'message', 'status',
    ];

    public function withTrip(): array
    {
        return $this->select('bookings.*, trips.title_id AS trip_title')
            ->join('trips', 'trips.id = bookings.trip_id', 'left')
            ->orderBy('bookings.id', 'DESC')
            ->findAll();
    }

    public function countNew(): int
    {
        return $this->where('status', 'new')->countAllResults();
    }
}
