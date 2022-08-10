<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetilmateritextResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'nama_materitext' => htmlspecialchars_decode(html_entity_decode(utf8_decode($this->nama_materitext))),
            'text' => htmlspecialchars_decode(html_entity_decode(utf8_decode($this->text))),
            'prev'=>$this->no_urut,
            'next'=>$this->no_urut,
        ];
    }
}
