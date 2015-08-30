<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = [
        'user_id',
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

}
