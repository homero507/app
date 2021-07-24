<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->as('subscription')->withTimestamps();
    }

}
