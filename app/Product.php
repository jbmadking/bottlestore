<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'quantity',
        'status'
    ];

    /**
     * Product Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsToMany('App\Category');
    }

    public function scopeFindByName($query, $product)
    {
        $query->where('name', '=', $product);
    }

}
