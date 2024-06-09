<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Note;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserInfo;
use App\Models\UserRole;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // $this->call(NoteSeeder::class);
        // $this->call(RoleSeeder::class);


        // User::factory(10)->create();
        // Image::factory(10)->create();
        // UserInfo::factory(10)->create();
        // Post::factory(30)->create();
        // Comment::factory(10)->create();
        // PostCategory::factory(5)->create();
        // PostTag::factory(5)->create();
        // Like::factory(10)->create();
        // Subscriber::factory(10)->create();

        // Role::factory()->create([
        //     'role' => 'user',
        // ]);

        // Role::factory()->create([
        //     'role' => 'super-admin',
        // ]);
        Role::factory()->create([
            'role' => 'admin',
        ]);
        Role::factory()->create([
            'role' => 'partnerships',
        ]);
        Role::factory()->create([
            'role' => 'hospitals',
        ]);
        Role::factory()->create([
            'role' => 'doctors',
        ]);
        Role::factory()->create([
            'role' => 'medical-officers',
        ]);
        Role::factory()->create([
            'role' => 'patients',
        ]);
        Role::factory()->create([
            'role' => 'emergencies',
        ]);

        // UserRole::factory(10)->create();




    }
}
