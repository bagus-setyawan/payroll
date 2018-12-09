<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'biodatas';

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

    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }

    public function golongan()
    {
        return $this->belongsTo('App\Golongan');
    }
}
