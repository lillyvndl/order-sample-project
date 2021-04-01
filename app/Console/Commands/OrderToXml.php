<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
