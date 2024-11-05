<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ListRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\UserRepository;
use App\Services\CountryService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    protected CountryService $countryService;

    public function __construct(UserRepository $userRepository, CountryService $countryService)
    {
        $this->userRepository = $userRepository;
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ListRequest $request): Application|Response|ResponseFactory
    {
        $data = $request->validated();

        $users = $this->userRepository->filterAndSortUsers($data);

        return $this->success([
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Application|Response|ResponseFactory
    {
        $data = $request->validated();
        $this->userRepository->createUser($data);

        return $this->success();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): Application|Response|ResponseFactory
    {
        $data = $request->validated();

        $user = $this->userRepository->updateUser($id, $data);
        return $user ? $this->success() : $this->error('User not found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Application|Response|ResponseFactory
    {
        $userDeleted = $this->userRepository->deleteUser($id);
        return $userDeleted ? $this->success() : $this->error('User not found.');
    }

    public function getCountries(): Application|Response|ResponseFactory
    {
        $countries = $this->countryService->getCountries();

        return $this->success([
            'countries' => $countries,
        ]);
    }
}
