<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['header', 'subHeader', 'mainText', 'image'];

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function likes(){
        return $this->hasMany(Post::class,'post_id','id');
    }
}
