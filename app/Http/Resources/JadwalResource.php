<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
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
            'pengajar'=>$this->pengajar->nama_pengajar,
            'mapel'=>$this->mapel->nama_mapel,
            'mapelid'=>$this->mapel->id,
            'hari'=>$this->hari,
            'dari'=>$this->dari_jam,
            'sampai'=>$this->sampai_jam
        ];
    }
}
