<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model {


    protected $fillable = ['product_id', 'product', 'quantity', 'price', 'subtotal'];
    /**
     * OrderItem Order
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }


}
