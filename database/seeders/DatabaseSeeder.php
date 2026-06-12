<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolClassSeeder::class,
            NotificationSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            MarkSeeder::class,
            AttendanceSeeder::class,
            StudentPermissionSeeder::class
        ]);
    }
}
