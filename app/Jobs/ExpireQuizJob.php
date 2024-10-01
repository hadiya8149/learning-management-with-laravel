<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Quiz;
class ExpireQuizJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $quizzes = Quiz::where('end_time','>=', now());
        foreach($quizzes as $quiz){
            $assignedQuizzes = $quiz->assignedQuizzes;
            foreach($assignedQuizzes as $assignedQuiz){
                Log::info('assigned quiz id');

                Log::info($assignedQuiz->id);

                $assignedQuiz->status='expired';
                $assignedQuiz->save();
                Log::info('status after chaning');
                Log::info($asignedQuiz->status);

            }
        }

    }
}
