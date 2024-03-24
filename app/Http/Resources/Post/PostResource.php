<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'post';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'       => $this->title,
            'guid'        => $this->guid,
            'description' => $this->description,
            'thumbnail'   => $this->thumbnail,
            'content'     => $this->content,
            'link'        => $this->link,
            'slug'        => $this->slug,
            'user_id'     => $this->user_id,
            'category_id' => $this->category_id,
            'created_at'  => $this->created_at,
            'deleted_at'  => $this->deleted_at,
        ];
    }
}
