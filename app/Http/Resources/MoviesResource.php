<?php

namespace App\Http\Resources;
use App\Models\Movies;
use App\Models\Genres;
use App\Http\Resources\MoviesResource;
use Illuminate\Http\Request;


use Illuminate\Http\Resources\Json\JsonResource;

class MoviesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}