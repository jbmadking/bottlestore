<?php namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class CartController extends Controller
{

    /**
     * Display Shopping Cart.
     *
     * @return Response
     */
    public function index()
    {

        $cartItems = Cart::content()->toArray();
        $cartTotal = Cart::total();

        return view('pages.partials.shopping.cart', compact('cartItems', 'cartTotal'));
    }

    /**
     * Add Product to Shopping Cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $product = $request->all();

            $cart = Cart::associate('Product', 'App');
            $cart->add(
                $product['id'],
                $product['name'],
                $product['quantity'],
                $product['price']
            );

            return $product['id'];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Remove a Product from Shopping Cart.
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function destroy(Request $request)
    {
        Cart::remove($request->get('id'));
    }

}
