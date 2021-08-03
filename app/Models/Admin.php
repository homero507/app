<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['credential_number'];

    public $timestamps = false;

    public function user()
    {

     return $this->morphMany(User::class, 'userable');

    }

}
