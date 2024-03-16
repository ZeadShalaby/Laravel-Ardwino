<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
         //todo collection of Revives
         $users = User::get();
         foreach ($users as $user) {
             $user -> update(['name' => "zead shalaby"]);
         }
 
        
    }
}
