<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
       
        //limit returned attributes
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user' => $this->user
        ];
    }
    
    //add anything to the request data
    public function with($request) {
        return [
            'version' => '1.0',
            'url' => url('http://myurl.com')
        ];
    }
}
