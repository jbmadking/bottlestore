<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street_number',
        'street_name',
        'suburb',
        'city',
        'province',
        'postal_code'
    ];

    /**
     * Category Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsToMany('App\Repositories\User');
    }


}
