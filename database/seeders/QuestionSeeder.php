<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
    [
        "user_id" => 1,
        "title" => "Laptop overheating",
        "body" => "How can I stop my laptop from overheating while gaming?"
    ],
    [
        "user_id" => 2,
        "title" => "Math homework help",
        "body" => "Can someone explain how to solve quadratic equations easily?"
    ],
    [
        "user_id" => 3,
        "title" => "Phone battery draining fast",
        "body" => "Why does my phone battery drain quickly even when not in use?"
    ],
    [
        "user_id" => 4,
        "title" => "React useEffect confusion",
        "body" => "How does useEffect work in React and when should I use dependencies?"
    ],
    [
        "user_id" => 5,
        "title" => "Fixing a leaking tap",
        "body" => "What tools do I need to repair a leaking water tap at home?"
    ],
    [
        "user_id" => 1,
        "title" => "Improving English grammar",
        "body" => "What are the best ways to improve my English grammar quickly?"
    ],
    [
        "user_id" => 2,
        "title" => "Laravel API authentication",
        "body" => "How do I protect API routes using Sanctum in Laravel?"
    ],
    [
        "user_id" => 3,
        "title" => "Slow internet connection",
        "body" => "Why is my WiFi speed slow only at night?"
    ],
    [
        "user_id" => 4,
        "title" => "JavaScript array methods",
        "body" => "What is the difference between map, filter, and reduce in JavaScript?"
    ],
    [
        "user_id" => 5,
        "title" => "Broken ceiling light",
        "body" => "My ceiling light keeps flickering. How can I fix it safely?"
    ]
    ];

    foreach( $questions as $question){
        Question::create($question);
    }
    }
}
