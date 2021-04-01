<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:process-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle all commands at once';

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
        $this->call('command:order-to-csv');
        $this->call('command:order-to-xml');
        $this->call('command:subscribe-to-mailchimp');
    }
}
