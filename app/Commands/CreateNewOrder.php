<?php namespace App\Commands;

use App\Events\NewCustomerOrderCreated;
use App\Order;
use App\OrderItem;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class CreateNewOrder extends Command implements SelfHandling
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var array
     */
    protected $orderItems;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        $this->session = new Session();

        $this->order = new Order();
    }

    /**
     * Execute the command.
     *
     * @param Request $request
     *
     * @return string|static
     */
    public function handle(Request $request)
    {
        try {

            if ($this->orderExists()) {

                $this->updateOrder($request);

                return $this->order;
            }

            $this->createOrder($request);

            event(new NewCustomerOrderCreated());

            return $this->order;

        } catch (Expeption $e) {

            return $e->getMessage();
        }
    }

    private function saveOrderItems()
    {

        foreach (Cart::content() as $key => $orderItem) {

            $this->orderItems[$key]['product_id'] = $orderItem->id;
            $this->orderItems[$key]['product'] = $orderItem->name;
            $this->orderItems[$key]['quantity'] = $orderItem->qty;
            $this->orderItems[$key]['price'] = $orderItem->price;
            $this->orderItems[$key]['subtotal'] = $orderItem->subtotal;
        }
        if (!empty($this->orderItems)) {

            foreach ($this->orderItems as $orderItem) {

                $this->order->orderItems()->create($orderItem);
            }
        }
    }

    /**
     * @return bool
     */
    private function orderExists()
    {
        $sessionOrder = $this->session->get(Auth::user()->id);

        if (!$sessionOrder) {

            return false;
        }

        $storageOrder = Order::findByInvoiceNumber($sessionOrder->invoice_no)->first();

        if ($storageOrder) {

            $this->order = $storageOrder;

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     */
    protected function createOrder(Request $request)
    {
        $this->order = Order::create(
            [
                'user_id' => Auth::user()->id,
                'billing_id' => $request->get('billing'),
                'shipping_id' => $request->get('shipping'),
                'status' => 'unpaid',
                'total' => Cart::total(),
                'invoice_no' => 'GENERATE_INVOICE_NO',
            ]
        );

        $this->saveOrderItems();

        $this->session->set(Auth::user()->id, $this->order);
    }

    private function deleteOrderItems()
    {
        $orderItems = $this->session->get(Auth::user()->id)->orderItems->toArray();

        if ($orderItems) {

            array_walk(
                $orderItems, function ($orderItem) {
                OrderItem::destroy($orderItem['id']);
            }
            );
        }
    }

    private function updateOrder()
    {
        $this->order->total = Cart::total();

        $this->order->save();

        $this->deleteOrderItems();

        $this->saveOrderItems();

        $this->session->set(Auth::user()->id, $this->order);
    }
}
