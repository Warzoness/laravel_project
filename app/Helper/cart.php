<?php

namespace App\Helper;

class Cart {
    private $items = [];
    private $total_quantity = 0;
    private $total_price = 0;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }

    public function list(){
        return $this->items;
    }
}