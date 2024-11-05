<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Services\CountryService;
use Illuminate\Validation\Rule;

class UpdateRequest extends ApiRequest
{
    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        parent::__construct();
        $this->countryService = $countryService;
    }

    public function rules(): array
    {
        $countries = array_column($this->countryService->getCountries(), 'name');
        $currencies = array_column($this->countryService->getCountries(), 'currency');

        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->route('user')],
            'country' => ['required', 'string', Rule::in($countries)],
            'currency' => ['required', 'string', Rule::in($currencies)],
        ];
    }
}
