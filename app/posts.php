<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    public function comentarios()
    {
        return $this->hasMany('App\comentarios');
    }
    protected $fillable = [
        'post','autor', 'description'
    ];
}
