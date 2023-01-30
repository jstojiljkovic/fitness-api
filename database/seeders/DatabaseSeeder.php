<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Role;
use App\Models\Equipment;
use App\Models\Organisation;
use App\Models\Step;
use App\Models\User;
use App\Models\Video;
use App\Models\Workout;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $organisation = Organisation::factory()->create();
        $user = User::factory()->create([
            'organisation_id' => $organisation->id,
            'email' => 'admin@graphene.com',
            'role' => Role::ADMIN
        ]);
        $data = [
            'organisation_id' => $organisation->id,
            'user_id' => $user->id,
        ];
        $equipments = Equipment::factory()
            ->count(20)
            ->create($data);

        $videos = Video::factory()
            ->count(20)
            ->has(Step::factory()->count(3))
            ->create($data);

        foreach ($videos as $video) {
            $data['video_id'] = $video->id;
            Workout::factory()
                ->hasEquipments($equipments->random(3))
                ->create($data);
        }
    }
}
