<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    public function posts()
    {
        return $this->belongsTo('App\posts');
    }
    protected $fillable = [
        'comentario', 'post_id'
    ];
}
