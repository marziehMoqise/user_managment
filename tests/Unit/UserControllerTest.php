<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // شبیه‌سازی پاسخ API کشورهای مورد استفاده در CountryService
        Http::fake([
            'https://restcountries.com/v3.1/all' => Http::response([
                ['name' => ['common' => 'Iran'], 'currencies' => ['IRR' => []]],
                ['name' => ['common' => 'USA'], 'currencies' => ['USD' => []]],
            ], 200),
        ]);
    }

    #[Test]
    public function it_can_list_users()
    {
        User::factory()->count(5)->create();

        $response = $this->getJson(route('users.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => ['users' => [['id', 'name', 'email', 'country', 'currency']]],
                'error'
            ])
            ->assertJson(['status' => 'success']);
    }

    #[Test]
    public function it_can_create_a_user()
    {
        $response = $this->postJson(route('users.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'country' => 'Iran',
            'currency' => 'IRR',
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson(route('users.update', $user->id), [
            'name' => 'Updated Name',
            'email' => $user->email,
            'country' => $user->country,
            'currency' => $user->currency,
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('users.destroy', $user->id));

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    #[Test]
    public function it_can_get_country_list()
    {
        $response = $this->getJson(route('countries.list'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => ['countries' => [['name', 'currency']]],
                'error'
            ])
            ->assertJson(['status' => 'success']);
    }
}
