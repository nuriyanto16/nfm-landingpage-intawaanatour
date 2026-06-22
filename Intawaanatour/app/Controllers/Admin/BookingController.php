<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;

class BookingController extends BaseController
{
    protected BookingModel $model;

    /** Status yang diizinkan untuk sebuah booking. */
    protected array $statuses = ['new', 'confirmed', 'cancelled', 'done'];

    public function __construct()
    {
        $this->model = new BookingModel();
    }

    public function index()
    {
        return view('admin/bookings/index', [
            'title'    => 'Pemesanan',
            'bookings' => $this->model->withTrip(),
            'statuses' => $this->statuses,
        ]);
    }

    public function setStatus($id, $status)
    {
        if (! in_array($status, $this->statuses, true)) {
            return redirect()->to('/admin/bookings')->with('error', 'Status tidak valid.');
        }

        if (! $this->model->find($id)) {
            return redirect()->to('/admin/bookings')->with('error', 'Data tidak ditemukan.');
        }

        $this->model->update($id, ['status' => $status]);

        return redirect()->to('/admin/bookings')->with('success', 'Status pemesanan diperbarui.');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/admin/bookings')->with('success', 'Pemesanan dihapus.');
    }
}
