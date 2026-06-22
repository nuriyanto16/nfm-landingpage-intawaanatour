<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripModel;
use App\Models\ArticleModel;
use App\Models\GalleryModel;
use App\Models\BookingModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $bookings = new BookingModel();

        return view('admin/dashboard', [
            'title'        => 'Dashboard',
            'totalTrips'   => (new TripModel())->countAll(),
            'totalArticle' => (new ArticleModel())->countAll(),
            'totalGallery' => (new GalleryModel())->countAll(),
            'totalBooking' => $bookings->countAll(),
            'newBooking'   => $bookings->countNew(),
            'recent'       => $bookings->withTrip(),
        ]);
    }
}
