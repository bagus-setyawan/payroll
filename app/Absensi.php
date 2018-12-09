<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'absensis';

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
     public function user()
     {
         return $this->belongsTo('App\User');
     }
}
