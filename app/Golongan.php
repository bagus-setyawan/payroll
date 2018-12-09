<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'golongans';

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
         return $this->hasMany('App\Biodata', 'golongan_id', 'id');
     }

     public function masa_kerja()
     {
         return $this->hasMany('App\MasaKerja', 'golongan_id', 'id');
     }
}
