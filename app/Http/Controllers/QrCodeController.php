<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
    {
        $data = QrCode::size(312)
            ->format('png')
            ->merge(public_path('assets/logo/border-black.png'), 0.47, true)
            ->errorCorrection('Q')
            ->generate('https://google.com');

        return response($data)
            ->header('Content-type', 'image/png');
    }
}
