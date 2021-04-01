<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SubscribeToMailchimp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:subscribe-to-mailchimp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Mailchimp contact from customers orders. Add clients to list based on order amount.';

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
        //
    }
}
