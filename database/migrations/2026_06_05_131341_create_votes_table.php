<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('votes')) {
            Schema::create('votes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->morphs('votable');
                $table->tinyInteger('type')->comment('1 for upvote, -1 for downvote');
                $table->timestamps();

                // Prevent duplicate votes
                $table->unique(['user_id', 'votable_id', 'votable_type'], 'votes_user_votable_unique');

                // Add indexes with shorter names to avoid duplicates
                $table->index(['votable_type', 'votable_id'], 'votes_votable_index');
                $table->index('type', 'votes_type_index');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
};
