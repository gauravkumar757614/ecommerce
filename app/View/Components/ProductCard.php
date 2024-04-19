<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product, $key;
    /**
     * Create a new component instance.
     */
    public function __construct($product, $key=null)
    {
        $this->product  =   $product;
        $this->key      =   $key;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}