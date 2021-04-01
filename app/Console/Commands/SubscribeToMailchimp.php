<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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
     * $var Collection
     */
    private $order;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->order = new Collection(
            json_decode(
                \App::call('App\Http\Controllers\OrderController@get'),
                true
            )
        );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $budget = $this->order->get('total');
        $customer = $this->order->get('billing');

        switch ($budget) {
            case ($budget < 50):
                $this->info("Add customer '" . $customer['first_name'] . " " . $customer['last_name'] . "' to Standard list");
                break;
            case ($budget < 250):
                $this->info("Add customer '" . $customer['first_name'] . " " . $customer['last_name'] . "' to Silver list");
                break;
            case ($budget < 2000):
                $this->info("Add customer '" . $customer['first_name'] . " " . $customer['last_name'] . "' to Gold list");
                break;
            default:
                $this->info("Add customer '" . $customer['first_name'] . " " . $customer['last_name'] . "' to default list");
        }
    }
}
