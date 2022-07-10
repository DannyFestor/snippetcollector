<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TagSeeder extends Seeder
{
    public function run()
    {
        $source_path = 'app/SVGs/';
        $target_path = 'app/public/';
        $svgs = [
            'laravel.svg',
            'alpinejs.svg',
            'livewire.svg',
            'inertia.svg',
            'go.svg',
            'flutter.svg',
            'javascript.svg',
            'typescript.svg',
            'tailwindcss.svg',
            'vue.svg',
            'svelte.svg',
            'react.svg',
        ];
        foreach ($svgs as $svg) {
            $source = storage_path($source_path . $svg);
            $target = storage_path($target_path . $svg);
            if (!File::exists($target) && File::exists($source)) {
                File::copy($source, $target);
            }
        }

//        Tag::factory(20)->create();
        Tag::insert([
            [
                'title' => 'Laravel',
                'color' => '#FF2D20',
                'bgcolor' => null,
                'bordercolor' => '#FF2D20',
                'logo' => 'laravel.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Alpine.js',
                'color' => '#8BC0D0',
                'bgcolor' => null,
                'bordercolor' => '#8BC0D0',
                'logo' => 'alpinejs.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Livewire',
                'color' => '#4E56A6',
                'bgcolor' => null,
                'bordercolor' => '#4E56A6',
                'logo' => 'livewire.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Inertia.js',
                'color' => '#835FE2',
                'bgcolor' => null,
                'bordercolor' => '#835FE2',
                'logo' => 'inertia.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'GO',
                'color' => '#00ADD8',
                'bgcolor' => null,
                'bordercolor' => '#00ADD8',
                'logo' => 'go.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Flutter',
                'color' => '#02569B',
                'bgcolor' => null,
                'bordercolor' => '#02569B',
                'logo' => 'flutter.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Javascript',
                'color' => '#F7DF1E',
                'bgcolor' => null,
                'bordercolor' => '#F7DF1E',
                'logo' => 'javascript.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Typescript',
                'color' => '#3178C6',
                'bgcolor' => null,
                'bordercolor' => '#3178C6',
                'logo' => 'typescript.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tailwind.css',
                'color' => '#06B6D4',
                'bgcolor' => null,
                'bordercolor' => '#06B6D4',
                'logo' => 'tailwindcss.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Vue.js',
                'color' => '#4FC08D',
                'bgcolor' => null,
                'bordercolor' => '#4FC08D',
                'logo' => 'vue.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Svelte',
                'color' => '#FF3E00',
                'bgcolor' => null,
                'bordercolor' => '#FF3E00',
                'logo' => 'svelte.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'React.js',
                'color' => '#61DAFB',
                'bgcolor' => null,
                'bordercolor' => '#61DAFB',
                'logo' => 'react.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
