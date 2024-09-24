<?php

namespace App\Console\Commands;
use App\Jobs\SendBulkEmailJob;

use App\Models\User;
use Illuminate\Console\Command;



class SendBulkEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-bulk-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bulk emails to the users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::query()->select('email')->get();
        // $data['emails']=$users;
        $data['subject']="Newsletter Email";
        $data['content'] = "This is a newsletter email.";
        SendBulkEmailJob::dispatch($data);
    }
}
