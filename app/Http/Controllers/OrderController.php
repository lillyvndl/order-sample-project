<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Get the order from a file on the server
     */
    public function get()
    {
        return file_get_contents(base_path('order.json'));
    }
}
