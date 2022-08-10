<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SoalResource extends JsonResource
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
            'id'=> $this->id,
            'groupsoal_id'=> $this->groupsoal_id,
            'uraian'=> htmlspecialchars_decode(html_entity_decode(utf8_decode($this->uraian))),
            'gambar'=> '<img src="'.url('/storage/upload/').$this->gambar.'" width="100%">',
            'opsia'=> $this->opsia,
            'opsib'=> $this->opsib,
            'opsic'=> $this->opsic,
            'opsid'=> $this->opsid,
            'opsie'=> $this->opsie,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
