<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    // private $id;
    // private $name;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'imageName' => Str::upper($this->name),
            'imagePath' => $this->url,
            /* 'secret' => $this->when(Auth::user()->isAdmin(), 'secret-value'), */
           /*  'posts' => PostResource::collection($this->posts), */
        ];
    }
}
