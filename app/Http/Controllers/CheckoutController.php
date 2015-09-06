<?php namespace App\Http\Controllers;


use App\Commands\CreateNewOrder;
use App\Commands\LoginSiteUser;
use App\Commands\RegisterGuestUser;
use App\Commands\SaveUserAddresses;
use App\OrderItems;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return view('checkout.register');
    }

    /**
     * @return Redirector
     */
    public function createUser()
    {
        $this->dispatch(new RegisterGuestUser($this->auth));

        return redirect('checkout/addresses');
    }

    /**
     * Show login screen
     */
    public function login()
    {
        return view('checkout.login');
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function authenticate()
    {
        $userLoggedIn = $this->dispatch(new LoginSiteUser);

        if (!$userLoggedIn) {

            flash('Unable to log you in');

            return redirect('checkout/login');
        }

        return redirect('checkout/addresses');
    }

    /**
     * show the form to select billing and shipping addresses
     *
     * @return Response
     */
    public function addresses()
    {
        if (!Auth::user()) {
            flash('Please Register first, or login if you are already registered', 'error');

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
     * @return Redirector
     */
    public function saveAddress(Request $request)
    {

        $this->dispatch(new SaveUserAddresses($request));

        $addresses = Auth::user()->addresses()->lists('street_name', 'id');

        return view('checkout.address', compact('addresses'));
    }

    /**
     * Display Order Payment form.
     *
     * @return Response
     */
    public function createOrder()
    {
        $order = $this->dispatch(new CreateNewOrder());

        return view('checkout.order', compact('order'));
    }
}
