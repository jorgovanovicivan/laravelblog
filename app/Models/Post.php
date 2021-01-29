<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
class Post extends Model
{
    use HasFactory,Commentable;
 protected $fillable=['title','body', 'user_id',];
  public function user(){


    return $this->belongsTo('App\Models\User');
  }


}
