<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Notifications\StudentSignupFormReceived;
use App\Notifications\InformAdminForSignupRequest;
use App\Models\User;
class SendRegistrationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $student;
    private $admin;
    public function __construct($student)
    {
        $this->student = $student;
        $this->admin = User::find(1);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->student->notify(new StudentSignupFormReceived);
        $this->admin->notify(new InformAdminForSignupRequest);

    }
}
