<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Category;

class Article extends JsonResource
{
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
            'name' => $this->title,
            'email' => $this->body,
            'created_at' => $this->created_at,            
            'user' => "/api/users/" . $this->user_id,
            'category_id' => "/api/categories/" . $this->category_id,
        ];
    }
}
