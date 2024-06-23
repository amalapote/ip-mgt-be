<?php

namespace Tests\Feature;

use App\Models\IpManagement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Laravel\Passport\Passport;

class IpManagementFeatureTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /**
     * @return void
     */
    public function test_can_create_ip(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );

        $payload = [
            'label' => $this->faker->word,
            'comment' => $this->faker->sentence,
            'ip_address' => $this->faker->ipv4,
        ];

        $response = $this->postJson('/api/v1/ip-management/store', $payload);

        $response->assertSuccessful();

    }

    /**
     * @return void
     */
    public function test_can_update_ip(): void
    {
        Passport::actingAs(
            $user = User::factory()->create(),
            ['create-servers']
        );

        $ipMgtSave = IpManagement::factory()->for($user)->create();

        $payload = [
            'label' => $this->faker->word,
            'comment' => $this->faker->sentence,
            'ip_address' => $this->faker->ipv4,
        ];

        $response = $this->put("/api/v1/ip-management/update/{$ipMgtSave->id}", $payload);

        $response->assertSuccessful();

    }

    /**
     * @return void
     */
    public function test_can_show_ip(): void
    {
        Passport::actingAs(
            $user = User::factory()->create(),
            ['create-servers']
        );

        $ipMgtSave = IpManagement::factory()->for($user)->create();

        $response = $this->get("/api/v1/ip-management/show/{$ipMgtSave->id}");

        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function test_can_show_lists_ip(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );

        $response = $this->get("/api/v1/ip-management/index");

        $response->assertSuccessful();
    }
}
