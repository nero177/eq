<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Enums\ArticleType;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [];

        for ($i = 0; $i < 70; $i++){
            $articles[] = [
                'title' => '{"uk":"Article ' . $i . '"}',
                'content' => '{"uk":"Content for article ' . $i.'"}',
                'short_desc' => '{"uk":"Description for article ' . $i.'"}',
                'type' => ArticleType::DEFAULT->value,
                'order' => $i
            ];
        }
        
        Article::upsert($articles, ['title']);
    }
}
