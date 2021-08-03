<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;


class User extends Authenticatable implements JWTSubject 
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_REVIEWER = 'ROLE_REVIEWER';
    public const ROLE_USER = 'ROLE_USER';

//    private const ROLES_HIERARCHY = [
//
//        self::ROLE_SUPERADMIN => [self::ROLE_ADMIN, ROLE_REVIEWER, self::ROLE_USER],
//        self::ROLE_ADMIN => [self::ROLE_USER],
//        self::ROLE_REVIEWER => [self::ROLE_USER],
//        self::ROLE_USER => []

//  ];

    private const ROLES_HIERARCHY = [
     self::ROLE_SUPERADMIN => [self::ROLE_ADMIN],
     self::ROLE_ADMIN => [self::ROLE_USER],
     self::ROLE_USER => []
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->as('subscription')->withTimestamps();
    }

     public function userable()
     {
        return $this->morphTo();
     }

//    public function isGranted($role)
//    {
//     return $role === $this->role || in_array($role, self::ROLES_HIERARCHY[$this->role]);
//    }

    public function isGranted($role)
    {
     if ($role === $this->role) {
     return true;
     }
     return self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$this->role]);
    }

    private static function isRoleInHierarchy($role, $role_hierarchy)
    {
     if (in_array($role, $role_hierarchy)) {
           return true;
        }

     foreach ($role_hierarchy as $role_included) {

        if(self::isRoleInHierarchy($role,self::ROLES_HIERARCHY[$role_included])){
            return true;
           } 

        }

        return false;
        
    }
    
}
