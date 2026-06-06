<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        // Get all users (assuming you have 5 users)
        $users = User::all();

        // Get all questions
        $questions = Question::all();

        // Answer templates for variety
        $answerTemplates = [
            "Great question! Here's what I think about this:",
            "I've been working with this for a while now. In my experience,",
            "This is a common question. The solution is usually",
            "Let me share what I've learned about this topic:",
            "I found that the best approach is to",
            "Based on my understanding,",
            "Here's a practical example:",
            "I recommend checking out the documentation for",
            "This helped me too when I was learning.",
            "One thing to keep in mind is that",
            "I struggled with this initially too. What worked for me was",
            "The Laravel community suggests",
            "From my experience, you should",
            "This is well explained in the official docs.",
            "A good practice for this is to"
        ];

        $answerEndings = [
            "Hope this helps!",
            "Let me know if you need more clarification.",
            "This should solve your problem.",
            "That's how I implement it in my projects.",
            "Feel free to ask if you have more questions.",
            "This is a common pattern in Laravel.",
            "I use this approach in production.",
            "It works perfectly for me.",
            "Give it a try and let me know.",
            "This is considered a best practice."
        ];

        $userCount = $users->count();
        $questionCount = $questions->count();

        echo "\n=========================================\n";
        echo "Starting Answer Seeder\n";
        echo "=========================================\n";
        echo "Users found: {$userCount}\n";
        echo "Questions found: {$questionCount}\n";
        echo "=========================================\n\n";

        $totalAnswers = 0;

        foreach ($questions as $question) {
            echo "Adding answers for question: {$question->title}\n";

            foreach ($users as $user) {
                // Generate a unique answer
                $template = $answerTemplates[array_rand($answerTemplates)];
                $ending = $answerEndings[array_rand($answerEndings)];

                // Create a personalized answer based on the question
                $answerBody = $this->generateAnswer($question->title, $template, $ending);

                // Create the answer
                Answer::create([
                    'body' => $answerBody,
                    'question_id' => $question->id,
                    'user_id' => $user->id,
                    'created_at' => now()->subDays(rand(0, 7))->subHours(rand(0, 48)),
                    'updated_at' => now(),
                ]);

                echo "  ✓ Answer by: {$user->name}\n";
                $totalAnswers++;
            }

            echo "  → Total answers for this question: 5\n\n";
        }

        echo "=========================================\n";
        echo "✅ Seeding Completed!\n";
        echo "=========================================\n";
        echo "Total answers created: {$totalAnswers}\n";
        echo "Expected answers: " . ($questionCount * $userCount) . "\n";
        echo "Each of {$userCount} users answered all {$questionCount} questions\n";
        echo "=========================================\n";
    }

    private function generateAnswer($questionTitle, $template, $ending)
    {
        // Extract keywords from question title for personalized answers
        $keywords = ['Laravel', 'Eloquent', 'migration', 'authentication', 'dependency',
                     'performance', 'service provider', 'file upload', 'repository', 'testing'];

        $foundKeyword = '';
        foreach ($keywords as $keyword) {
            if (stripos($questionTitle, $keyword) !== false) {
                $foundKeyword = $keyword;
                break;
            }
        }

        // Generate a more personalized answer if we found a keyword
        if ($foundKeyword) {
            $specificAnswers = [
                'Laravel' => "Laravel is a fantastic PHP framework. I've been using it for years. {$template} learn Laravel step by step, starting with the basics. {$ending}",
                'Eloquent' => "Eloquent ORM makes database interactions a breeze. {$template} use relationships properly. For example, a User has many Posts. {$ending}",
                'migration' => "Migrations are version control for your database. {$template} create a migration using `php artisan make:migration`. {$ending}",
                'authentication' => "Laravel provides several authentication options. {$template} use Laravel Breeze for simple auth or Jetstream for more features. {$ending}",
                'dependency' => "Dependency injection is a key concept in Laravel. {$template} type-hint dependencies in your constructors or methods. {$ending}",
                'performance' => "Performance optimization is crucial. {$template} use caching, optimize queries, and implement queues for slow tasks. {$ending}",
                'service provider' => "Service providers bootstrap your application. {$template} register bindings, event listeners, and middleware here. {$ending}",
                'file upload' => "File uploads need proper handling. {$template} validate files, store them using Laravel's Filesystem, and always sanitize names. {$ending}",
                'repository' => "The repository pattern adds an abstraction layer. {$template} separate your business logic from data access code. {$ending}",
                'testing' => "Testing is essential for robust applications. {$template} write feature tests for HTTP endpoints and unit tests for classes. {$ending}"
            ];

            if (isset($specificAnswers[$foundKeyword])) {
                return $specificAnswers[$foundKeyword];
            }
        }

        // Default answer format
        return "{$template} {$this->getRandomAdvice()} {$ending}";
    }

    private function getRandomAdvice()
    {
        $advice = [
            "always check the official Laravel documentation first.",
            "make sure to test your code thoroughly.",
            "consider using Laravel's built-in features before custom solutions.",
            "keep your code clean and follow PSR standards.",
            "use type hinting and return types for better code quality.",
            "implement proper error handling and validation.",
            "write meaningful comments for complex logic.",
            "follow the DRY principle (Don't Repeat Yourself).",
            "use Laravel's collections for data manipulation.",
            "take advantage of Laravel's helper functions."
        ];

        return $advice[array_rand($advice)];
    }
}
