<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasaKerja extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'masa_kerjas';

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
     public function golongan()
     {
         return $this->belongsTo('App\Golongan', 'golongan_id', 'id');
     }
}
