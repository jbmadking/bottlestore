<?php namespace App\Commands;

use App\Events\ProductRemovedFromShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

class RemoveProductFromShoppingCart extends Command implements SelfHandling
{

    /**
     *
     */
    protected $productId;

    /**
     * Create a new command instance.
     *
     * @param $productId
     */
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        Cart::remove($this->productId);

        event(new ProductRemovedFromShoppingCart);
    }

}
