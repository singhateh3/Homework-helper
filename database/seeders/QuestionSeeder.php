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
            // Technology & Programming
            [
                "user_id" => rand(1, 5),
                "title" => "Laptop overheating",
                "body" => "How can I stop my laptop from overheating while gaming? The fan runs loudly and the system shuts down."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Math homework help",
                "body" => "Can someone explain how to solve quadratic equations easily? I'm struggling with the quadratic formula."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Phone battery draining fast",
                "body" => "Why does my phone battery drain quickly even when not in use? I've tried closing all apps."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "React useEffect confusion",
                "body" => "How does useEffect work in React and when should I use dependencies? I'm getting infinite loops."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Fixing a leaking tap",
                "body" => "What tools do I need to repair a leaking water tap at home? Is it a DIY job or should I call a plumber?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Improving English grammar",
                "body" => "What are the best ways to improve my English grammar quickly? I need to pass an exam."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Laravel API authentication",
                "body" => "How do I protect API routes using Sanctum in Laravel? I want to implement token-based authentication."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Slow internet connection",
                "body" => "Why is my WiFi speed slow only at night? During the day it works perfectly."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "JavaScript array methods",
                "body" => "What is the difference between map, filter, and reduce in JavaScript? When should I use each one?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Broken ceiling light",
                "body" => "My ceiling light keeps flickering. How can I fix it safely without calling an electrician?"
            ],
            // Science & Education
            [
                "user_id" => rand(1, 5),
                "title" => "Photosynthesis process",
                "body" => "Can someone explain the process of photosynthesis in simple terms? I need it for my biology exam."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Python vs Java performance",
                "body" => "Which is faster for web development: Python or Java? I'm choosing a backend language."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "History of the internet",
                "body" => "When was the internet invented and who were the key contributors? I'm writing a paper."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Chemical reaction examples",
                "body" => "What are some common examples of exothermic reactions in everyday life?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Geometry proofs help",
                "body" => "I need help proving the Pythagorean theorem. What's the simplest proof?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Machine learning basics",
                "body" => "What are the prerequisites for learning machine learning? I'm a beginner."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "DNA replication explained",
                "body" => "Can someone explain DNA replication in simple terms for my biology class?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "CSS flexbox guide",
                "body" => "How does flexbox work in CSS? I'm struggling with centering elements."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Roman Empire timeline",
                "body" => "What are the key events in the rise and fall of the Roman Empire?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "OOP concepts in programming",
                "body" => "Can someone explain the four pillars of object-oriented programming with examples?"
            ],
            // Personal Development & Lifestyle
            [
                "user_id" => rand(1, 5),
                "title" => "Time management techniques",
                "body" => "What are the best time management techniques for students? I'm overwhelmed with assignments."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Healthy eating habits",
                "body" => "How can I build healthy eating habits without feeling deprived? Need meal plan ideas."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Public speaking anxiety",
                "body" => "How do I overcome public speaking anxiety? I have a presentation next week."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Productivity apps",
                "body" => "What are the best productivity apps for college students? Need to organize my schedule."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Morning routine tips",
                "body" => "What's a good morning routine for better productivity throughout the day?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Stress management",
                "body" => "How can I manage stress during exams? I feel anxious and can't focus."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Better sleep habits",
                "body" => "What are scientifically proven methods to improve sleep quality?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Online learning tips",
                "body" => "How do I stay motivated while taking online courses? I get easily distracted."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Effective note-taking",
                "body" => "What's the most effective note-taking method for lectures? I'm trying different systems."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Goal setting strategies",
                "body" => "How do I set realistic goals and actually achieve them? Need a step-by-step guide."
            ],
            // Home & DIY
            [
                "user_id" => rand(1, 5),
                "title" => "Cleaning carpet stains",
                "body" => "What's the best way to remove old carpet stains? I've tried several methods."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Gardening for beginners",
                "body" => "What are easy plants to grow for someone who's never gardened before?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Painting walls correctly",
                "body" => "How to paint interior walls without leaving streaks? I'm doing a home renovation."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Decluttering your home",
                "body" => "What's the best method for decluttering when you have too many things?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Energy efficiency tips",
                "body" => "How can I make my home more energy-efficient to reduce electricity bills?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Kitchen organization",
                "body" => "What are smart ways to organize a small kitchen to maximize space?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "DIY furniture repairs",
                "body" => "How to fix wobbly table legs? I'm on a budget and can't buy new furniture."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Removing bad odors",
                "body" => "What are natural ways to remove bad odors from rooms and furniture?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Outdoor maintenance",
                "body" => "How to maintain wooden decking to prevent weather damage? Need long-term advice."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Smart home devices",
                "body" => "Which smart home devices are worth buying for a beginner? I want to automate my home."
            ],
            // Miscellaneous
            [
                "user_id" => rand(1, 5),
                "title" => "Interview preparation",
                "body" => "What are the most common interview questions and how should I answer them?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Stock market for beginners",
                "body" => "How to start investing in the stock market with little money? I'm a complete beginner."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Travel planning",
                "body" => "What are the best websites for planning budget-friendly international travel?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Photography basics",
                "body" => "What are the key photography settings for beginners using a DSLR camera?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Freelancing success",
                "body" => "How to become a successful freelancer with no experience? Need practical advice."
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Career change advice",
                "body" => "How do I change careers at 30 without going back to university full-time?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Video game development",
                "body" => "What tools do I need to start developing video games as a hobby?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Sustainable living",
                "body" => "What are simple changes I can make to live a more sustainable lifestyle?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Cooking for students",
                "body" => "What are easy, cheap, and healthy recipes for college students?"
            ],
            [
                "user_id" => rand(1, 5),
                "title" => "Book recommendations",
                "body" => "What are must-read books for personal development and self-improvement?"
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
