<?php

namespace App\Services;

class ApiService
{
    /**
     * Contoh method untuk memanggil API eksternal.
     */
    public function getShippingRates($destination, $weight)
    {
        // Logika HTTP Client (Guzzle/Http Facade) di sini
        // return Http::get('...');
        return [
            'jne' => 10000,
            'tiki' => 12000,
        ];
    }
}
