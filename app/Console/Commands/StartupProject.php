<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'startup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'One-line startup project command ;D';

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
        $this->call('key:generate');
        $this->call('migrate:fresh');
        $this->call('orchid:admin', [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '123123'
        ]);
//        $this->call('db:seed');
    }
}
