<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = config('services.rajaongkir.base_url', 'https://api.rajaongkir.com/starter');
    }

    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/province');

        return $this->handleResponse($response);
    }

    /**
     * Get cities by province ID
     */
    public function getCities($provinceId = null)
    {
        $params = [];
        if ($provinceId) {
            $params['province'] = $provinceId;
        }

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/city', $params);

        return $this->handleResponse($response);
    }

    /**
     * Calculate shipping cost
     * 
     * @param int $origin City ID of origin
     * @param int $destination City ID of destination
     * @param int $weight Weight in grams
     * @param string $courier Courier code (jne, pos, tiki)
     */
    public function getCost($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . '/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        return $this->handleResponse($response);
    }

    protected function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }

        return [];
    }
}
