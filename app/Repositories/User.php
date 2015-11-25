<?php namespace App\Repositories;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'is_admin'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @param $query
     */
    public function scopeIsAdmin($query)
    {
        $query->where('is_admin', '=', true);
    }

    /**
     * @param $query
     */
    public function scopeIsClient($query)
    {
        $query->where('is_admin', '=', false);
    }

    /**
     * Encrypt password before persisting
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Addresses for a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany('App\Repositories\Address', 'user_addresses');
    }

    /**
     * Orders for a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Repositories\Order');
    }

    /**
     * @param $userInfo
     *
     * @return static
     */
    public static function findByUserNameOrCreate($userInfo)
    {
        return User::firstOrCreate(
            [
                'name' => $userInfo->name,
                'email' => $userInfo->email,
            ]
        );
    }
}
