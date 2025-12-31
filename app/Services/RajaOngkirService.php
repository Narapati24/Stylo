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
        ])->get($this->baseUrl . '/destination/province');

        return $this->handleResponse($response);
    }

    /**
     * Search destination (cities/subdistricts)
     */
    public function searchDestination($query)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/destination/domestic-destination', [
            'search' => $query,
            'limit' => 10
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Calculate shipping cost
     * 
     * @param int $origin City/Subdistrict ID of origin
     * @param int $destination City/Subdistrict ID of destination
     * @param int $weight Weight in grams
     * @param string $courier Courier code (jne, pos, tiki)
     */
    public function getCost($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->asForm()->post($this->baseUrl . '/calculate/domestic-cost', [
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
            $body = $response->json();
            if (isset($body['data'])) {
                return $body['data'];
            }
            // Fallback for old structure if needed, or just return body
            return $body;
        }

        \Illuminate\Support\Facades\Log::error('RajaOngkir API Error: ' . $response->status() . ' - ' . $response->body());

        return [];
    }
}
