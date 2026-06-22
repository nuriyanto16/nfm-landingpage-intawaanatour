<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * CAPTCHA gambar mandiri (tanpa layanan eksternal / kunci API).
 * Jawaban disimpan di SESSION (server-side), bukan di cookie/HTML,
 * dan hanya berlaku sekali + kedaluwarsa 5 menit.
 */
class Captcha extends BaseController
{
    public function image(): ResponseInterface
    {
        // Hindari karakter ambigu (0/O, 1/I, dll.)
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code  = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        // Simpan di sesi untuk diverifikasi saat login
        session()->set([
            'captcha_answer' => $code,
            'captcha_time'   => time(),
        ]);

        $w = 150;
        $h = 50;
        $img = imagecreatetruecolor($w, $h);

        $bg = imagecolorallocate($img, 245, 247, 250);
        imagefilledrectangle($img, 0, 0, $w, $h, $bg);

        // Garis-garis derau
        for ($i = 0; $i < 6; $i++) {
            $lc = imagecolorallocate($img, random_int(150, 210), random_int(150, 210), random_int(150, 210));
            imageline($img, random_int(0, $w), random_int(0, $h), random_int(0, $w), random_int(0, $h), $lc);
        }
        // Titik-titik derau
        for ($i = 0; $i < 220; $i++) {
            $dc = imagecolorallocate($img, random_int(160, 220), random_int(160, 220), random_int(160, 220));
            imagesetpixel($img, random_int(0, $w), random_int(0, $h), $dc);
        }

        // Tulis tiap karakter dengan posisi vertikal acak
        $font = 5; // font bawaan GD terbesar
        $x    = 14;
        for ($i = 0; $i < strlen($code); $i++) {
            $tc = imagecolorallocate($img, random_int(10, 70), random_int(40, 90), random_int(60, 120));
            $y  = random_int(8, 22);
            // gambar 2x agar lebih tebal/terbaca
            imagestring($img, $font, $x, $y, $code[$i], $tc);
            imagestring($img, $font, $x + 1, $y, $code[$i], $tc);
            $x += 26;
        }

        ob_start();
        imagepng($img);
        $png = (string) ob_get_clean();
        imagedestroy($img);

        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->setHeader('Pragma', 'no-cache')
            ->setBody($png);
    }
}
