<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shifts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
     protected $guarded = ['id'];


     /**
      * Relations
      *
      * @return void
      */
     public function biodata()
     {
         return $this->hasMany('App\Biodata', 'shift_id', 'id');
     }
}
