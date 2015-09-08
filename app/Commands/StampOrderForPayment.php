<?php namespace App\Commands;

use App\Order;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

class StampOrderForPayment extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $invoiceNo;

    /**
     * Create a new command instance.
     *
     * @param int $invoiceNo
     */
    public function __construct($invoiceNo)
    {
        $this->invoiceNo = $invoiceNo;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::findByInvoiceNumber($this->invoiceNo);

        if ($order) {

            $order->update(['status' => 'unpaid']);

            return true;
        }

        return false;
    }

}
