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
    public function handle()
    {
        //
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

        $csv->output($tableName . '.csv');
    }
}
