<?php

namespace App\Console\Commands;

use App\Mail\CronJobSendMail as MailCronJobSendMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CronJobSendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userList = User::where('role', '=', 0)->get();
        $email = new MailCronJobSendMail();

        foreach ($userList as $key => $user) {
            Mail::to($user->email)->send($email);
        }
    }
}