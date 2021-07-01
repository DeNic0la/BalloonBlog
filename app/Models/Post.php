<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['header', 'subHeader', 'mainText', 'image'];

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function likes(){
        return $this->hasMany(Post::class,'post_id','id');
    }
}
