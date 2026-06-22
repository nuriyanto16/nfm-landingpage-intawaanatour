<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Booking extends BaseController
{
    public function store()
    {
        $rules = [
            'name'  => 'required|min_length[3]|max_length[120]',
            'phone' => 'required|min_length[6]|max_length[40]',
            'email' => 'permit_empty|valid_email',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new BookingModel();
        $model->insert([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'trip_id'   => $this->request->getPost('trip_id') ?: null,
            'trip_date' => $this->request->getPost('trip_date') ?: null,
            'pax'       => $this->request->getPost('pax') ?: null,
            'message'   => $this->request->getPost('message'),
            'status'    => 'new',
        ]);

        // Pesan WhatsApp prefilled agar pengunjung bisa lanjut chat
        $waMsg = t('Halo Intawaanatour, saya ', 'Hi Intawaanatour, I am ')
            . $this->request->getPost('name')
            . t(' ingin memesan trip.', ' would like to book a trip.');

        return redirect()->back()
            ->with('success', t('Terima kasih! Permintaan Anda telah kami terima. Tim kami akan segera menghubungi Anda.', 'Thank you! Your request has been received. Our team will contact you shortly.'))
            ->with('wa', wa_link($waMsg));
    }
}
