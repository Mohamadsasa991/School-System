<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('session_checkpoints', function (Blueprint $table) {
            $table->id();

    $table->foreignId('student_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('session_date');

    $table->integer('participating_count')->default(0);

    $table->integer('not_paying_count')->default(0);

    $table->integer('max_inattention_streak')->default(0);

    $table->integer('state_transitions')->default(0);


    $table->integer('aggression_event_count')->default(0);

    $table->integer('wrist_oscillation_count')->default(0);
    $table->dateTime('checkpoint_time');

    $table->integer('body_sway_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_checkpoints');
    }
};
