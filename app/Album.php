<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Album extends Model
{
  protected $fillable = [
    'name',
    'description',
    'photo'
  ];
    public function photos() {
      return $this->hasMany('App\Photo');
    }
}
