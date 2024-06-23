<?php

namespace Database\Seeders;

use App\Models\IpManagement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IpManagement::factory()
            ->for(User::factory()->create())
            ->count(100)->create();
    }
}
