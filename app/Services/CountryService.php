<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CountryService
{
    /**
     * Get the list of countries and currencies from the API.
     *
     * @return array
     */
    public function getCountries(): array
    {
        // Check cache to avoid repeated requests
        return Cache::remember('countries', 86400, function () {
            $response = Http::get('https://restcountries.com/v3.1/all');

            if ($response->successful()) {
                $countries = [];

                foreach ($response->json() as $country) {
                    $countries[] = [
                        'name' => $country['name']['common'] ?? null,
                        'currency' => array_key_first($country['currencies'] ?? []),
                    ];
                }

                return $countries;
            }

            return [];
        });
    }
}
