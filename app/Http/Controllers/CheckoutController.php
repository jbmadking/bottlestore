<?php namespace App\Http\Controllers;


use App\Order;
use App\OrderItems;
use App\User;
use App\Http\Requests\UserRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Guard as Authenticator;


class CheckoutController extends Controller
{
    /**
     * @var
     */
    private $auth;


    /**
     * @param Authenticator $auth
     */
    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display Check Out Landing Page
     *
     * @return Response
     */
    public function index()
    {

        //TODO: add-command CheckOutShoppingCart
        $cartItems = Cart::content()->toArray();
        $cartTotal = Cart::total();

        return view('checkout.index', compact('cartItems', 'cartTotal'));
    }

    /**
     * Show the form to register new site user.
     *
     * @return Response
     */
    public function register()
    {
        //TODO: add-command RegisterGuestUser
        return view('checkout.register');
    }

    /**
     * @param UserRequest $request
     *
     * @return RedirectResponse|Redirector
     */
    public function createUser(UserRequest $request)
    {
        //TODO: add-command CreateGuestUser
        $user = User::create($request->all());

        $this->auth->login($user);

        return redirect('checkout/address');
    }

    /**
     * Show login screen
     */
    public function login()
    {
        return view('checkout.login');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function authenticate(Request $request)
    {
        if (!$this->auth->attempt(
            $request->except(['_token', 'remember', 'login_user']),
            $request->get('remember')
        )
        ) {
            flash('Unable to log you in');

            return redirect('checkout/login');
        }

        return redirect('checkout/address');
    }

    /**
     * show the form to select billing and shipping addresses
     *
     * @return Response
     */
    public function address()
    {
        //TODO: add-command SelectBillingAndShippingAddress
        if (!Auth::user()) {
            return redirect('checkout/register');
        }

        $addresses = Auth::user()->addresses()->lists('street_name', 'id');

        return view('checkout.address', compact('addresses'));

    }

    /**
     * Saves a User's selected addresses
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function saveAddress(Request $request)
    {

        //TODO: add-command SaveAddresses
        $shippingAddress = array_filter($request->get('shipping'));
        $billingAddress = array_filter($request->get('billing'));

        if (!empty($billingAddress)) {
            Auth::user()->addresses()->create($request->get('billing'));
        }

        if (!empty($shippingAddress)) {
            Auth::user()->addresses()->create($request->get('shipping'));
        }

        return redirect('checkout/address');

    }

    /**
     * Display Order Payment form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
        //TODO: add-command CreateNewOrder
        $orderItems = Cart::content();

        $order = Order::create(
            [
                'user_id' => Auth::user()->id,
                'billing_id' => $request->get('billing'),
                'shipping_id' => $request->get('shipping'),
                'status' => 'new',
                'total' => Cart::total()
            ]
        );

        foreach ($orderItems as $orderItem) {

            $orderItemArray['product_id'] = $orderItem->id;
            $orderItemArray['product'] = $orderItem->name;
            $orderItemArray['quantity'] = $orderItem->qty;
            $orderItemArray['price'] = $orderItem->price;
            $orderItemArray['subtotal'] = $orderItem->subtotal;

            $order->orderItems()->create($orderItemArray);
        }

//        var_dump($order->user);
//        dd($order);
        return view('checkout.order', compact('order'));
    }
}
