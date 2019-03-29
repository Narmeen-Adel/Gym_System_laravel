<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Customer;
use App\Notifications\InvoicePaid;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send email ror unloged user for 30 days ';

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
     * @return mixed
     */
    public function handle()
    {
        $users =Customer::where('last_login ', '< =', Carbon::now()->subMonth()->toDateString())->get()->toArray();
        if($arr!=[]){
            foreach ($users as $user){
                Notification::route('mail', $user->email)->notify(new InvoicePaid($user->email));
            }
        }
       
    }  

}
