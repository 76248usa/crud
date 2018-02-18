<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Photo extends Model
{

  protected $fillable = [
    'album_id',
    'description',
    'photo_photo',
    'title',
    'size'

  ];

    public function album(){
      $this->belongsTo('App\Album');
    }
}
