<?php namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    /**
     * Category Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Repositories\Product');
    }

    /**
     * Category Parent Category
     */
    public function parent()
    {
        return $this->belongsTo('App\Repositories\Category');
    }

    /**
     * Category Children
     */
    public function children()
    {
        return $this->hasMany('App\Repositories\Category', 'parent_id');
    }

    /**
     * Pre-format Created At date
     *
     * @param $date
     */
    public function setCreatedAtAttribute($date)
    {
        $this->attributes['created_at'] = Carbon::parse($date);
    }

    /**
     * Pre-format Updated At date
     *
     * @param $date
     */
    public function setUpdatedAtAttribute($date)
    {
        $this->attributes['updated_at'] = Carbon::parse($date);
    }

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = strtolower(str_replace(' ', '-', $slug));
    }

    public static function findBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public function scopeRootCategories($query)
    {
        $query->where('parent_id', '=', 0);
    }

}
