<?php

namespace App\Listeners;

use App\Events\QuizAssigned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\ActivateQuizJob;
class ActivateQuizCreation implements  ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param  \App\Events\QuizAssigned  $event
     * @return void
     */
   
    public function handle(QuizAssigned $event)
    {
        Log::info('quiz assigned event listener called');
        // handle the logic of activate after 2 days
        // queueu
        Log::info($event->quiz);
        ActivateQuizJob::dispatch($event->quiz)->delay(now()->addMinutes(5));

    }
}
