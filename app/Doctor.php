<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Department;
use App\User;

class Doctor extends Model
{
    protected $table = 'users';
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function (Builder $builder) {
            $builder->has('dept');
        });
    }

    protected $fillable = [
        'name', 'email','password','mobile','status','photo','type','gender',
    ];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',"email_verified_at",
    ];

    public function dept()
    {
        return $this->hasOne(Department::class);
    }


}
