<?php namespace App\Commands;

use App\Events\ProductAddedToShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Bus\SelfHandling;

class AddProductToShoppingCart extends Command implements SelfHandling
{

    /**
     * @var array
     */
    protected $product;

    /**
     * Create a new command instance.
     *
     * @param array $product
     */
    public function __construct(array $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the command.
     *
     * @return string
     */
    public function handle()
    {
        try {

            $cart = Cart::associate('Product', 'App\Repositories');

            $cart->add(
                $this->product['id'],
                $this->product['name'],
                $this->product['quantity'],
                $this->product['price']
            );

            event(new ProductAddedToShoppingCart());

            return $this->product['id'];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

}
