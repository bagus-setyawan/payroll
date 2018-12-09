<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
     protected $guarded = ['id'];
     
     /**
      * Relation : User
      *
      * @return void
      */
     public function user()
     {
         return $this->hasMany('App\User', 'role_id', 'id');
     }
}
