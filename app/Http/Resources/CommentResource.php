<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'comments';

    public function toArray($request)
    {return $this->resource->map(function ($comment) {
        return [
            'id' => $comment->id,
            'text' => $comment->text,
            'post' => new PostResource($comment->post),
        ];
    });
}
}