<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'body', 'id_user'];

   /* public static function boot()
    {

        $user = User::find(1);

        
        parent::boot();
        static::creating(function ($article){

            $article->user_id = Auth::id();

        });
    }*/

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
