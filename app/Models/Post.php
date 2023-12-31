<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'caption',
        'image'
    ];
    protected $primaryKey = 'id';
    protected $table = 'posts';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->belongsToMany(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
