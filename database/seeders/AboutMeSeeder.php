<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutMeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_me')->insert([
            'name' => 'Haziel Gomez',
            'bio' => 'Soy desarrollador full-stack apasionado por Laravel, Supabase y la creación de sistemas POS. Me gusta aprender nuevas tecnologías y compartir conocimiento.',
            'profile_image' => 'https://eqitdadlawkqdnltcqap.supabase.co/storage/v1/object/sign/profile%20photo/hazielgmzphoto.jpeg?token=eyJraWQiOiJzdG9yYWdlLXVybC1zaWduaW5nLWtleV9hYmEzYzIxYi1jZmIyLTQ5ODktODAzMy0zYTJkM2EwMzc0YTciLCJhbGciOiJIUzI1NiJ9.eyJ1cmwiOiJwcm9maWxlIHBob3RvL2hhemllbGdtenBob3RvLmpwZWciLCJpYXQiOjE3NTcwNjI5MzgsImV4cCI6MjA3MjQyMjkzOH0.lh1K5xQhlMUlW69yg24aCnajYJXWOYuBnD6CZ0eJvqU'
        ]);
    }
}
