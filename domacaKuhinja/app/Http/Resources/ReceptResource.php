<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'recept';
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'Naziv recepta'=>$this->resource->naziv_recepta,
            'Opis recepta'=>$this->resource->opis_recepta,
            'Korisnik' => new UserResource($this->resource->user),
            'Kategorija' => new KategorijaResource($this->resource->kategorija)
        ];

    }
}
