<?php

namespace Tests\Unit;

use App\Models\IpManagement;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IpManagementModelTest extends TestCase
{
    use refreshDatabase;
    /**
php      * A basic unit test example.
     */
    public function test_models_can_be_instantiated(): void
    {
        $user = User::factory()->create();

        $ipMgtSave = IpManagement::factory()->for($user)->create();

        $this->assertModelExists($ipMgtSave);

        $this->assertTrue(true);
    }
}
