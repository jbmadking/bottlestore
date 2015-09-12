<?php namespace App\Commands;

use App\Events\ProductRemovedFromShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class RemoveProductFromShoppingCart
 *
 * @package App\Commands
 */
class RemoveProductFromShoppingCart extends Command implements SelfHandling
{

    /**
     * @var
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
