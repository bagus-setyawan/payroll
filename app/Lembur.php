<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lemburs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
     protected $guarded = ['id'];
}
