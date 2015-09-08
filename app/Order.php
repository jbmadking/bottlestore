<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'invoice_no',
        'billing_id',
        'shipping_id',
        'status',
        'total'
    ];

    /**
     * Order OrderItems
     *
     * @return HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    /**
     * An Order's User
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * An Order's Shipping Address
     *
     * @return BelongsTo
     */
    public function shippingAddress()
    {
        return $this->belongsTo('App\Address', 'shipping_id', 'id');
    }

    /**
     * An Order's Billing Address
     *
     * @return BelongsTo
     */
    public function billingAddress()
    {
        return $this->belongsTo('App\Address', 'billing_id', 'id');
    }

    /**
     *
     */
    public function setInvoiceNoAttribute()
    {
        $this->attributes['invoice_no'] = $this->generateInvoiceNumber();
    }

    /**
     * @param $query
     *
     * @param $invoiceNumber
     */
    public function scopeFindByInvoiceNumber($query, $invoiceNumber)
    {
        $query->where('invoice_no', '=', $invoiceNumber);
    }

    /**
     * @param $query
     */
    public function scopeNewOrder($query)
    {
        $query->where('status', '=', 'new');
    }

    /**
     * Generates a unique invoice number
     *
     * @return string
     */
    private function generateInvoiceNumber()
    {
        $invoice_no = 'INV' . mt_rand(100000, 999999);
        $order = Order::where(['invoice_no' => $invoice_no])->get(['invoice_no']);

        if (count($order)) {
            $this->generateInvoiceNumber();
        }

        return $invoice_no;
    }

}
