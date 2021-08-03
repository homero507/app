<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\writer;
use App\Models\User as user_models;

class User extends JsonResource
{

    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [

             'id' => $this->id,  
             'name' => $this->name,
             'email' => $this->email,
             $this->merge($this->userable),
             'created_at' => $this->created_at,
             'updated_at' => $this->updated_at,
             'token' => $this->when($this->token, $this->token),           
        ];
    }

    public function token($token)
    {
        $this->token = $token;
    }

}
