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
        Schema::create('daily_summaries', function (Blueprint $table) {
            $table->id();
               $table->foreignId('student_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('summary_date');

    $table->float('avg_participating_count')->nullable();

    $table->float('avg_not_paying_count')->nullable();

    $table->float('avg_state_transitions')->nullable();

    $table->float('avg_recovery_latency_s')->nullable();

    $table->integer('max_inattention_streak')->default(0);

    $table->integer('total_aggression_events')->default(0);

    $table->integer('max_aggression_in_window')->default(0);

    $table->integer('total_wrist_oscillations')->default(0);

    $table->integer('total_body_sway_events')->default(0);

    $table->integer('observation_window_minutes')->default(0);

    $table->longText('staff_report_text')->nullable();

    $table->longText('parent_report_text')->nullable();
    $table->text('review_status')
    ->default('PENDING_REVIEW');

    $table->dateTime('generated_at')
    ->nullable();

    $table->unique([
    'student_id',
    'summary_date'
]);

            $table->timestamp('report_generated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_summaries');
    }
};
