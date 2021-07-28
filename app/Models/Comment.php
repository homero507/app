<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Article; 
use App\Models\User;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'user_id', 'article_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id', 'id')->latestOfMany();
    }

    public function article()
    {
        return $this->belongsToMany(Article::class, 'article_id', 'id')->latestOfMany();
    }    

    /*public static function boot()
    {

        parent::boot();
        static::creating(function ($commen){
            
            $commen->user_id = Auth::id();

        });
    }*/
    
    
    
}
