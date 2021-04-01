<?php

namespace App\Console\Commands;

use DOMException;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Spatie\ArrayToXml\ArrayToXml;

class OrderToXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:order-to-xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export an order to xml';

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
        $this->comment($this->description);

        if ($this->order->isEmpty()) {
            $this->error('Order is empty!');

            return 0;
        }

        try {
            $result = ArrayToXml::convert($this->order->toArray(), 'order');

            $this->info($result);
        } catch (DOMException $e) {
            $this->error('Invalid Character Error!');
        }

    }
}
