<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class createadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {email}{password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create admin';

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
        $email=$this->argument('email');
        $password=$this->argument('password');
        try{
           User::create(["email"=>$email,"password"=>bcrypt($password)]);
           $this->info($email .' is '. $password);
        }catch(\PDOException $e){
         $this->error(" not avilable email or password");
        }
       
      

    }
}
