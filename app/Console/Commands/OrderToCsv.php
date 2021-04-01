<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use League\Csv\Writer;
use SplTempFileObject;

class OrderToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:order-to-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export an order to csv';

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
    public function handle(Collection $order)
    {
        if ($this->order->isEmpty()) {
            $this->error('Order is empty!');

            return 0;
        }

        $this->createCsv('order');
    }

    /**
     * Generate a CSV
     *
     * @param string $name
     */
    private function createCsv($name)
    {
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->setDelimiter(';');

        /**
         * Insert the order data
         */
        $csv->insertOne([
            $this->order->get('id'),
            $this->order->get('number'),
            $this->order->get('created_via'),
            $this->order->get('status'),
            $this->order->get('currency'),
            $this->order->get('date_created'),
        ]);

        /**
         * Insert the price data
         */
        $csv->insertOne([
            $this->order->get('total'),
            $this->order->get('total_tax'),
            $this->order->get('discount_total'),
            $this->order->get('discount_tax'),
            $this->order->get('shipping_total'),
            $this->order->get('shipping_tax'),
        ]);

        /**
         * Insert the customer data
         */
        $csv->insertOne([
            $this->order->get('billing')['first_name'],
            $this->order->get('billing')['last_name'],
            $this->order->get('billing')['address_1'],
            $this->order->get('billing')['city'],
            $this->order->get('billing')['postcode'],
            $this->order->get('billing')['country'],
            $this->order->get('billing')['email'],
        ]);

        /**
         * Insert the order lines data
         */
        foreach ($this->order->get('line_items') as $lineItem) {
            $csv->insertOne([
                $lineItem['id'],
                $lineItem['name'],
                $lineItem['product_id'] . '-' . $lineItem['variation_id'],
                $lineItem['price'],
                $lineItem['quantity'],
                $lineItem['total'],
                $lineItem['total_tax'],
            ]);
        }

        $csv->output($name . '.csv');
    }
}
