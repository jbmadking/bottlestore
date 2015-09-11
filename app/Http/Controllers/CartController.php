<?php namespace App\Http\Controllers;

use App\Commands\AddProductToShoppingCart;
use App\Commands\RemoveProductFromShoppingCart;
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
        return $this->renderCart();
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
        $product = $request->only(['id', 'name', 'quantity', 'price']);

        $this->dispatch(new AddProductToShoppingCart($product));

        return $this->renderCart();
    }

    /**
     * Remove a Product from Shopping Cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->dispatch(new RemoveProductFromShoppingCart($request->get('id')));

        return $this->renderCart();
    }

    /**
     * @return \Illuminate\View\View
     */
    protected function renderCart()
    {
        $cartItems = Cart::content()->toArray();

        $cartTotal = Cart::total();

        $checkoutAction = 'editCart';

        return view('pages.partials.shopping.cart', compact('cartItems', 'cartTotal', 'checkoutAction'));
    }

}
